@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">{{ $user[0]->givenname}} Profil</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update', $user[0]->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="givenname" class="col-md-4 col-form-label text-md-right">Vorname</label>

                            <div class="col-md-6">
                                <input id="givenname" type="text" class="form-control @error('givenname') is-invalid @enderror" name="givenname" value="{{ $user[0]->givenname }}" required autocomplete="givenname" autofocus>

                                @error('givenname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nachname</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user[0]->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Addresse</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user[0]->email}}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="department" class="col-md-4 col-form-label text-md-right">Abteilung</label>

                            <div class="col-md-6">
                                <input id="department" type="text" class="form-control @error('department') is-invalid @enderror" name="department" value="{{ $user[0]->department }}" autocomplete="department" autofocus>

                                @error('department')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="role_request" class="col-md-4 col-form-label text-md-right">Beantragende Rolle</label>

                            <div class="col-md-6">
                                <input id="role_request" type="text" class="form-control @error('role_request') is-invalid @enderror" name="role_request" value="{{ $user[0]->role_request }}" autocomplete="role_request" disabled autofocus>

                                @error('role_request')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3">
                            <label for="role" class="col-md-4 col-form-label text-md-right">Rolle</label>

                            <div class="col-md-6">
                                <select id="role" type="text" class="form-control @error('role') is-invalid @enderror" name="role" required autocomplete="role" autofocus>
                                    <option value='guest'>Gast</option>
                                    <option value='user'>User</option>
                                    <option value='admin'>Administrator</option>
                                </select>
                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Profil aktualisieren
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.updatepw', $user[0]->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Passwort</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Passwort bestätigen</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-warning">
                                    Passwort aktualisieren
                                </button>
                            </div>
                        </div>
                    </form>
                    <form method="POST" action="{{ route('admin.delete', $user[0]->id) }}">
                    <div class="row mb-0 mt-3">
                        <div class="col-md-6 offset-md-4">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger">
                                Konto löschen
                            </button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
