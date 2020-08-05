@extends('layouts.app')
@section('title', "Создать новый блог")
@section('content')
    <form action="{{ route('blogs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Заголовок</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title"
                   value="{{ old('title') }}" autofocus>
            @error('title')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="category">Категория</label>
            <select class="form-control @error('category') is-invalid @enderror" id="category" name="category">
                <option value="0">Выберите категорию</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category') == $category->id ? 'selected' : ''  }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            @error('category')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <div class="form-group">
            <label for="cover">Выберите обложку</label>
            <input type="file" name="cover" id="cover" style="display: none">
            <button type="button" class="btn btn-dark form-control" id="btn-cover">Загрузить обложку</button>
        </div>
        <div class="form-group">
            <label for="content">Содержимое</label>
            <textarea class="form-control @error('category') is-invalid @enderror" id="content" name="content">
                {{ old('content') }}
            </textarea>
            @error('content')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
        <button class="btn btn-primary">Сохранить</button>
    </form>
    <script src="{{ asset('ckeditor/ckeditor.js') }}"></script>
    <script>
        $(document).ready(function () {
            CKEDITOR.replace('content');
            $('#btn-cover').click(function () {
                $('input[name="cover"]').click();
            })
        });
    </script>

@endsection