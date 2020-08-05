@extends('layouts.app')
@section('title', 'Админка')
@section('content')
    <div class="card">
        <div class="card-header">
            Список категорий
        </div>
        <div class="card-body">
            @if(!$categories->count())
                <b>Не найдено ни одной категории</b>
            @else
                <table class="table table-bordered table-sm">
                    <thead>
                    <tr>
                        <th scope="col" width="10%">#</th>
                        <th scope="col" width="70%">Категория</th>
                        <th scope="col" width="20%">Действие</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($categories as $category)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>{{ $category->name }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('categories.edit', $category) }}" class="btn btn-warning btn-sm">Редактировать</a>
                                    <form action="{{ route('categories.destroy', $category) }}" method="post"
                                          style="padding-left: 2px;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Удалить</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @endif
            <div class="row">
                <a href="{{ route('categories.create') }}" class="btn btn-success btn-sm"
                   style="position: relative; left: 50%; transform: translate(-50%, 0);">Добавить категорию</a>
            </div>
        </div>
    </div>
@endsection