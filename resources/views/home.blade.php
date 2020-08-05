@extends('layouts.app')
@section('title', "Профиль пользователя")
@section('content')
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Профиль пользователя
                        @if($user->is_admin)
                            <span style="float: right"><b>Администратор сайта</b></span>
                        @endif
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col col-sm-6">
                                <p><b>Имя: </b>{{ $user->name }}</p>
                                <p><b>Фамилия: </b>{{ $user->surname }}</p>
                                <p><b>Дата рождения: </b>{{ $user->birth_date }} <i>(полных лет: {{ $age }})</i></p>
                                <p><b>E-mail адрес: </b>{{ $user->email }}</p>
                                <p><b>Последний визит: </b>{{ $user->last_visit }}</p>
                                <a href="{{ route('edit-profile') }}" class="btn btn-primary btn-sm">Редактировать профиль</a>
                            </div>
                            <div class="col col-sm-6">
                                <img src="{{ Storage::url('avatars/'.$user->avatar) }}" height="200"
                                     alt="{{ $user->name . ' ' . $user['surname'] }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
