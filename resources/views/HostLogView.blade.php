{{-- Übergabeparameter: $logs --}}
@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header">Logs zu  <a href="/host/edit/{{ $host->id }}" type="button" class="btn btn-outline-dark btn-sm">{{ $host->hostname ?? 'kein Hostname'}} | {{ $host->address }}</a></div>
                    <div class="card-body">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>
                                    Wechselt zu Status
                                </th>
                                <th>
                                    Uhrzeit
                                </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($logs as $log)
                                <tr>
                                    <td>
                                        @if ($log->state == 'Up')
                                            <span class="text-success"><b>Up</b></span>
                                        @elseif($log->state == 'Down')
                                            <span class="text-danger"><b>Down</b></span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $log->created_at }}
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
