@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                <div class="card-body">
                @foreach($networks as $network)
                    <!-- Für jedes Netzwerk eine Tabelle -->
                    <table class="table table-striped table-hover">
                        <caption>Netzwerksegment {{$network->net_addr}}/{{$network->netmask}} von {{ $network->creator->givenname }} {{ $network->creator->name }}</caption>
                        <tr>
                            <th>Hostname</th>
                            <th>IP-Adresse</th>
                            <th>Status</th>
                            <th>Bemerkung</th>
                            @auth
                            @if(Auth::user()->role === 'admin' || Auth::user()->role === 'user')
                            <th></th>
                            <th></th>
                            @endif
                        @endauth
                        </tr>
                    @if($network->hosts->count()>0)
                        @foreach($network->hosts as $host)
                            <tr class="{{ $host->state=='Down' ? 'table-danger': 'table-success'}}">
                                <td>{{$host->hostname}}</td>
                                <td>{{$host->address}}</td>
                                <td>{{$host->state}}</td>
                                <td>{{$host->note}}</td>
                                @auth
                                @if(Auth::user()->role === 'admin' || Auth::user()->role === 'user')
                                <td>
                                    <a href='host/edit/{{ $host->id }}' class='btn btn-sm btn-outline-success'>Edit</a>
                                </td>
                                <td>
                                    <a href='logs/{{ $host->id }}' class='btn btn-sm btn-outline-info'>Logs</a>
                                </td>
                                @endif
                            @endauth

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4"><p>Keine Hosts im Netzwerk Segment verfügbar!</p></td>
                        </tr>
                    @endif
                    </table>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
