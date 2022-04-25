@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Словарь:</h1>
    @if(!empty($words))
        <words-list :words="{{ $words }}"/>
    @else
        <p>У вас пока-что нет словарей, а значит и слов нет :(</p>
    @endif
</div>
@endsection
