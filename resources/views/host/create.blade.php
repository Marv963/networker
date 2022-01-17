@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">Host manuell anlegen</div>

                <div class="card-body">

                    <form autocomplete="off" action="/host" method="post" enctype="multipart/form-data">

                        @csrf
                        <div class="form-group">
                            <label for="hostname">Hostname</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('hostname') ? 'border-danger' : '' }}"
                                   placeholder="Client Nr. X" id="hostname" name="hostname"
                                   value="{{ old('hostname') }}">
                            <small class="form-text text-danger">{!! $errors->first('hostname') !!}</small>
                        </div>

                        <div class="form-group">
                            <label for="address">IPv4 Adresse</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('netmask') ? 'border-danger' : '' }}"
                                   placeholder="192.168.178.123" id="address" name="address" value="{{ old('address') }}">
                            <small class="form-text text-danger">{!! $errors->first('address') !!}</small>
                        </div>

                        <div class="form-group">
                        <label for="network_id">Netzsegment</label>
                        <select class="form-select" aria-label="Default select example" size="3" id="network_id" name="network_id">
                            @foreach($networks as $network)
                                <option value = "{{$network->id}}">{{$network->net_addr}}</option>
                            @endforeach
                        </select>
                        </div>

                        <div class="form-group">
                            <label for="note">Notiz</label>
                            <input type="text"
                                   class="form-control {{ $errors->has('note') ? 'border-danger' : '' }}"
                                   placeholder="Client von Max Mustermann" id="note" name="note" value="{{ old('note') }}">
                            <small class="form-text text-danger">{!! $errors->first('note') !!}</small>
                        </div>

                        <input class="btn btn-success mt-4" type="submit" value="Host hinzufügen">
                    </form>
                    <a class="btn btn-primary btn-sm mt-3 float-right" href="/network"><i
                            class="fas fa-arrow-circle-up"></i> Zurück</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
