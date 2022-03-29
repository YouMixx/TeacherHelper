@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row gx-2 gy-2">
       <h1>Ваши словари:</h1>
       @if(!empty($books_names))
            @foreach($books_names as $book)
                    <div class="col-4">
                        <a href="/translated/{{ $loop->index }}" class="text-decoration-none text-reset">
                            <div class="shadow rounded text-reset p-2 d-flex flex-column">
                                <h4 class="m-0">{{ $book['name'] }}</h4>
                                <span>Количество слов: {{ $book['count'] }}</span>
                                <span>Дата создания: {{ $book['date_created'] }}</span>
                            </div>
                        </a>
                    </div>
            @endforeach
            <a href="/clear-books" class="text-decoration-none text-reset text-center mt-4">Удалить все словари</a>
        @else  
            <p>У вас пока-что нет словарей :(</p>
        @endif
    </div>
</div>
@endsection
