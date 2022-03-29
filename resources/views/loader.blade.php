@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12 col-lg-6 m-auto shadow py-2">
            <form method="POST" action="{{ route('load_file') }}" enctype="multipart/form-data">
                {{ csrf_field() }}

                <div class="mb-3 {{ $errors->has('name_books') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <label for="name_books">Введите имя словаря</label>
                        <input id="name_books" type="text" class="form-control" name="name_books" required>
                        @if ($errors->has('name_books'))
                            <span class="help-block">
                                <strong>{{ $errors->first('name_books') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-3 {{ $errors->has('csv_file') ? ' has-error' : '' }}">
                    <div class="col-md-12">
                        <label for="csv_file">Выберите и загрузите файл CSV формата</label>
                        <input id="csv_file" type="file" class="form-control" name="csv_file" required>

                        @if ($errors->has('csv_file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('csv_file') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">
                            Загрузить
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
