@extends('layouts.app')
@section('title', "Главная")
@section('content')
    <h5>Последние добавленные</h5>
    <div class="row">
        @foreach ($blogs as $blog)
            <div class="card border-info sm-3" style="max-width: 15rem;">
                <div class="card-header">
                    <h6 style="text-align: center ">{{ $blog->user->name . ' ' . $blog->user->surname }}</h6>
                    <span style="text-align: right; font-size: small;">
                                        <small>Категория :
                                            <a href="{{ $blog->category_id  }}">{{ $blog->category->name }}</a>
                                        </small>
                                    </span><br>
                    <span style="font-size: x-small; color: black">Опубликовано: {{ $blog->created_at }}</span>
                </div>
                <div class="card-body text-info">
                    @if($blog->cover)
                        <img class="card-img-top" src="{{ Storage::url($blog->cover) }}"
                             alt="Card image cap">
                    @endif
                    <h6 class="card-title" style="text-align: center">
                        <a href="{{route('blogs.show', $blog)}}">{{ $blog->title }}</a>
                    </h6>
                    <p class="card-text"
                       style="text-align: justify">{!! mb_substr(strip_tags($blog->content), 0, 50) !!} ...</p>
                    <small style="font-size: xx-small">Количество просмотров: {{ $blog->views }}</small>
                </div>
            </div>
        @endforeach
    </div>
@endsection