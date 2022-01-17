@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header">{{ __('Netzwerk bearbeiten') }}</div>
                    <div class="card-body">
                        <form autocomplete="off" action="/network/{{ $network->id }}" method="post"
                              enctype="multipart/form-data">

                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="netaddr">IPv4 Adresse</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('netaddr') ? 'border-danger' : '' }}"
                                       placeholder="192.168.172.0" id="netaddr" name="netaddr"
                                       value="{{ $network->net_addr }}">
                                <small class="form-text text-danger">{!! $errors->first('net_addr') !!}</small>
                            </div>
                            <div class="form-group">
                                <label for="netmask">Netzmaske in CIDR</label>
                                <input type="text"
                                       class="form-control {{ $errors->has('netmask') ? 'border-danger' : '' }}"
                                       placeholder="24" id="netmask" name="netmask" value="{{ $network->netmask }}">
                                <small class="form-text text-danger">{!! $errors->first('netmask') !!}</small>
                            </div>
                            <input class="btn btn-success mt-4" type="submit" value="Bearbeiten">
                        </form>
                        <a class="btn btn-primary btn-sm mt-3 float-right" href="/network"><i
                                class="fas fa-arrow-circle-up"></i> Zurück</a>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
