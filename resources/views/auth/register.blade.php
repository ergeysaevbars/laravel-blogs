@extends('layouts.app')
@section('title', "Регистрация")
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Регистрация</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Имя</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                       class="form-control @error('name') is-invalid @enderror"
                                       name="name" value="{{ old('name') }}" autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="surname" class="col-md-4 col-form-label text-md-right">Фамилия</label>
                            <div class="col-md-6">
                                <input id="surname" type="text"
                                       class="form-control @error('surname') is-invalid @enderror"
                                       name="surname" value="{{ old('surname') }}">
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">Год рождения</label>
                            <div class="col-md-6">
                                <select id="year" class="form-control @error('year') is-invalid @enderror"
                                        name="year">
                                    <option value="0">Выберите год рождения</option>
                                    @for ($year = 2020; $year > 1900; $year-- )
                                        <option value="{{ $year }}" {{ $year == old('year') ? 'selected' : '' }}>
                                            {{ $year }}
                                        </option>
                                    @endfor;
                                </select>
                                @error('year')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="month" class="col-md-4 col-form-label text-md-right">Месяц</label>
                            <div class="col-md-6">
                                <select id="month" class="form-control @error('month') is-invalid @enderror"
                                        name="month">
                                    <option value="0">Выберите месяц</option>
                                    @foreach($months as $n => $month)
                                        <option value="{{ $n }}" {{ $n == old('month') ? 'selected' : '' }}>
                                            {{ $month }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('month')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="year" class="col-md-4 col-form-label text-md-right">День</label>
                            <div class="col-md-6">
                                <select id="day" class="form-control @error('day') is-invalid @enderror"
                                        name="day">
                                    <option value="0">Выберите день</option>
                                    @for ($day = 1; $day <= 31; $day++ )
                                        <option value="{{ $day }}" {{ $day == old('day') ? 'selected' : '' }}>
                                            {{ $day }}
                                        </option>
                                    @endfor;
                                </select>
                                @error('day')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail адрес</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                       class="form-control @error('email') is-invalid @enderror"
                                       name="email" value="{{ old('email') }}">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Пароль</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                       class="form-control @error('password') is-invalid @enderror" name="password"
                                >
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">
                                Подтвердить пароль
                            </label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control"
                                       name="password_confirmation">
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-block">Зарегистрироваться</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
