@extends('layouts.app')
@section('title', "Мои блоги")
@section('content')
    Блоги, добавленные Вами
    @foreach($blogs as $blog)
        <div class="card mb-3">
            <div class="card-header">
                <b>Автор: </b>{{ $blog->user->name . ' ' . $blog->user->surname }}
                <small style="float: right">Категория: <b>{{ $blog->category->name }}</b></small>
            </div>
            <div class="card-body">
                <h5 class="card-title">{{ $blog->title }}</h5>
                <p class="card-text">{!! mb_substr(strip_tags($blog->content), 0, 200) !!} ...</p>
                <a href="{{route('blogs.show', $blog)}}" class="btn btn-link">Читать далее</a>
                <span style="float: right"><small class="text-muted">Опубликовано: {{ $blog->created_at }}</small></span>
            </div>
        </div>
    @endforeach
@endsection