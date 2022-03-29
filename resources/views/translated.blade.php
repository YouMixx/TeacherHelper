@extends('layouts.app')

@section('content')
<div class="container">
    <translated-words :words="{{ $collection }}" />
</div>
@endsection