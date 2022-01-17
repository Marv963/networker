@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">Host anpassen</div>

                <div class="card-body">
                        <form method='POST' action="{{ route('host.update', $host->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="hostname" class="col-md-4 col-form-label text-md-right">Hostname</label>

                            <div class="col-md-6">
                                <input id="hostname" type="text" class="form-control @error('hostname') is-invalid @enderror" name="hostname" value="{{ $host->hostname }}" required autocomplete="hostname" autofocus>

                                @error('hostname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-right">address</label>

                            <div class="col-md-6">
                                <input id="address" disabled type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ $host->address }}" required autocomplete="address" autofocus>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="state" class="col-md-4 col-form-label text-md-right">Status</label>

                            <div class="col-md-6">
                                <input id="state" disabled type="text" class="form-control @error('state') is-invalid @enderror" name="state" value="{{ $host->state }}" required autocomplete="state" autofocus>

                                @error('state')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="note" class="col-md-4 col-form-label text-md-right">Notiz</label>

                            <div class="col-md-6">
                                <input id="note" type="text" class="form-control @error('note') is-invalid @enderror" name="note" value="{{ $host->note }}" required autocomplete="note" autofocus>

                                @error('note')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success">
                                    Host aktualisieren
                                </button>
                            </div>
                        </div>
                    </form>
                        <form method='POST' action="{{ route('host.delete',$host->id) }}">
                        <div class="row mb-0 mt-3">
                            <div class="col-md-6 offset-md-4">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger">
                                    Host löschen
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
