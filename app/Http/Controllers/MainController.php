<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ImportRequest;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class MainController extends Controller
{
    public function index()
    {
        return view('layouts.app');
    }

    public function loadFile(Request $request)
    {  
        // $key = array_search('Test title', array_column($array, 'name'));
        // dd($key);
        // return;
        
        /*
         * В ТЗ не было указано, как я должен индифицировать пользователя для сохранения его словарей.
         * Я бы без проблем сделал авторизацию, но не хотел выходить из поставленного ТЗ.
         * Так-что сделал сохранение словарей в сессию
        */

        // Проверка имени букваря на занятность (локально у пользователя)
        $nb = $request->name_book;
        $session_books = session('books');
        
        if($session_books != null) {
            $key = array_search($nb, array_column($session_books, 'name'));
            if($key !== false) {
                // return redirect()->back()->withErrors(['name_books' => 'Ошибка! Словарь с данным именем уже существует']);
                return response()->json([
                    'status' => false,
                    'message' => 'Ошибка! Словарь с данным именем уже существует',
                ]);
            }
        }

        // Обработка файла
        $path = $request->file->getRealPath();
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

        session()->push('books', [
            'name' => $nb,
            'count' => count($collection->get($data[0][0])),
            'words' => $collection,
            'date_created' => Carbon::now()->toDateTimeString(),
        ]);
        session()->save();

        return response()->json([
            'status' => true,
        ]);
    }

    public function showWordBooks()
    {
        $books = session('books');
        return response()->json([
            'status' => true,
            'books' => $books,
        ]); 

        // $books = session('books');
        // return view('wordbooks', compact('books'));
    }

    public function showBooks($id)
    {
        $collection = session('books');
        if($collection == null || !array_key_exists($id, $collection)) {
            return redirect('wordbooks');
        }
        $collection = $collection[$id]['words'];
        return response()->json([
            'status' => true,
            'words' => $collection,
        ]); 
        // return view('translated', compact('collection'));
    }

    // public function showAllWords()
    // {
    //     $books = session('books');
    //     $books = json_encode($books);
    //     return view('words-list', compact('books'));
    // }

    public function clearBooks()
    {
        session()->forget('books');
        session()->save();
        return response()->json([
            'status' => true,
        ]); 
    }
}