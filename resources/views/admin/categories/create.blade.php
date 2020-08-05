@extends('layouts.app')
@section('title', "Админка | " . @isset($category) ? "Редактирование категории" : "Новая категория")
@section('content')
    <form action="{{ isset ($category) ? route('categories.update', $category) : route('categories.store') }}" method="post">
        <div class="form-group">
            @csrf
            @isset($category)
                @method('PUT')
            @endisset
            <label for="name">Наименование категории</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                   value="{{ $category->name ?? '' }}" autofocus>
            @error('name')
            <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">{{ isset($category) ? 'Редактировать' : 'Добавить' }}</button>
    </form>
@endsection