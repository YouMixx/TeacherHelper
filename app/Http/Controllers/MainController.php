<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImportRequest;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class MainController extends Controller
{
    public function loadFile(ImportRequest $request)
    {  
        // session()->forget('books_names');
        // session()->push('books_names', 'Имя');
        // session()->save();

        // $nb = 'Test title';
        // session()->push('books_names_test', [
        //     'name' => $nb,
        //     'count' => 5,
        //     'date_created' => '2017-12-23',
        // ]);
        // $array = session('books_names_test');
        // $key = array_search('Test title', array_column($array, 'name'));
        // dd($key);
        // return;
        
        /*
         * В ТЗ не было указано, как я должен индифицировать пользователя для сохранения его словарей.
         * Я бы без проблем сделал авторизацию, но не хотел выходить из поставленного ТЗ.
         * Так-что сделал сохранение словарей в сессию
        */

        // Проверка имени букваря на занятность (локально у пользователя)
        $nb = $request->name_books;
        $session_books = session('books_names');

        if($session_books != null) {
            $key = array_search($nb, array_column($session_books, 'name'));
            if($key !== false) {
                return redirect()->back()->withErrors(['name_books' => 'Ошибка! Словарь с данным именем уже существует']);
            }
        }

        // Обработка файла
        $path = $request->file('csv_file')->getRealPath();
        $data = file($path);

        $data = array_map(function ($elem) {
            $elem = trim($elem, "\xEF\xBB\xBF");
            return str_replace("\r\n", '', explode(';', $elem));
        }, $data);

        foreach ($data as $key => $row) {
            if($key == 0) continue;
            $words[$data[0][0]][$key-1] = $row[0];
            $words[$data[0][1]][$key-1] = $row[1];
        }

        $collection = new Collection();
        $collection->put($data[0][0], $words[$data[0][0]]);
        $collection->put($data[0][1], $words[$data[0][1]]);

        // session()->push('books_names', $nb);
        session()->push('books_names', [
            'name' => $nb,
            'count' => count($collection->get($data[0][0])),
            'date_created' => Carbon::now()->toDateTimeString(),
        ]);
        session()->push('books_collections', $collection);
        session()->save();

        // return view('translated', compact('collection'));
        return redirect('wordbooks');
    }

    public function showWordBooks()
    {
        $books_names = session('books_names');
        // dd($books_names[0]['name']);
        return view('wordbooks', compact('books_names'));
    }

    public function showBooks($id)
    {
        $collection = session('books_collections');
        if(!array_key_exists($id, $collection)) {
            return redirect()->back();
        }
        $collection = $collection[$id];
        return view('translated', compact('collection'));
    }
    public function clearBooks()
    {
        session()->forget('books_names');
        session()->forget('books_collections');
        // session()->push('books_names', 'Имя');
        session()->save();
        return redirect('wordbooks');
    }
}