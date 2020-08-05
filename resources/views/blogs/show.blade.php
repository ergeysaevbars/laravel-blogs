@extends('layouts.app')
@section('title', $blog->title)
@section('content')
    <div class="card text-center">
        <div class="card-header">
            {{ $blog->user->name . ' ' . $blog->user->surname }}
            <div class="row">
                <div class="col-sm-6">
                        <span class="text-left">
                            <small>Категория: <a href="#">{{ $blog->category->name }}</a></small>
                        </span>
                </div>
                <div class="col-sm-6">
                    <span class="text-right"><small>Количество просмотров: {{ $blog->views }}</small></span>
                </div>
            </div>
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $blog->title }}</h5>
            @if($blog->cover)
                <img class="card-img" src="{{ Storage::url($blog->cover) }}" style="width: 50%; height: 50%"
                     alt="Card image">
            @endif
            <p class="card-text" style="text-align: justify">{!! $blog->content !!}</p>
        </div>
        <div class="card-footer text-muted">Опубликовано: {{ $blog->created_at }}</div>
    </div>
    </div>
@endsection