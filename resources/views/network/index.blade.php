{{-- Übergabeparameter: $networks --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header">{{ __('Netzwerke') }}</div>
                    <div class="card-body">
                        @if($networks->count() > 0)
                            <div class="row">
                                <table class="table table-striped table-hover">
                                    <caption>Angemeldete Netzwerksegmente: {{ $networks->count() }}</caption>
                                    <tr>
                                        <th>Netzadresse</th>
                                        <th>Netzmaske</th>
                                        <th>Hosts</th>
                                        <th>Broadcast Adresse</th>
                                        <th>Bearbeiten</th>
                                    </tr>
                                    @foreach($networks as $network)
                                        <tr>
                                            <td>{{ $network->net_addr }}</td>
                                            <td>{{ $network->netmask }}</td>
                                            <td>{{ $network->acthost }} / {{ $network->maxhost }}</td>
                                            <td>{{ $network->broadcast_addr }}</td>
                                            <td>

                                                <form class="float-right" style="display: inline"
                                                      action="/network/{{ $network->id }}" method="post">
                                                    @csrf
                                                    @method("DELETE")
                                                    <input class="btn btn-sm btn-outline-danger"
                                                           type="submit" value="Löschen">
                                                </form>

                                                <a href="/network/{{$network->id}}/edit">
                                                    <button type="button" class="btn btn-outline-primary btn-sm ">
                                                        Bearbeiten
                                                    </button>
                                                </a>

                                                <a href="host/create">
                                                    <button type="button" class="btn btn-outline-success btn-sm ">
                                                        Add Host
                                                    </button>
                                                </a>

                                                <a href="/network/{{$network->id}}/export">
                                                    <button type="button" class="btn btn-outline-secondary btn-sm ">
                                                        Export (CSV)
                                                    </button>
                                                </a>


                                            </td>
                                        </tr>
                                    @endforeach

                                </table>
                            </div>
                            <div class="row">
                                <a href="/network/create">
                                    <button type="button" class="btn btn-primary w-100">Neues Netzwerk anmelden!
                                    </button>
                                </a>
                            </div>
                        @else
                            <div class="alert alert-primary" role="alert">
                                Es sind keine Netzwerksegmente angelegt!
                            </div>
                            <a href="/network/create">
                                <button type="button" class="btn btn-primary w-100">Netzwerk anmelden!</button>
                            </a>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
