@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 pt-4">
            <div class="card">
                <div class="card-header">{{ __('Admin Panel') }}</div>
                <div class="card-body">
                    <table class="table table-striped table-hover">
                        
                    <tr>
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>Email</th>
                        <th>Abteilung</th>
                        <th>Rolle</th>
                        <th>Angefragte Rolle</th>
                        <th></th>
                    </tr>
                    @csrf
                    @foreach($users as $user)
                    <tr class="{{ $user->role !== $user->role_request && $user->role_request ? 'table-danger': 'table-success'}}">
                    <td>{{ $user->givenname }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->department }}</td>
                    <td>{{ $user->role }}</td>
                    <td>{{ $user->role_request }}</td>
                    <td>
                        <a href='admin/edit/{{ $user->id }}' class='btn btn-sm btn-success'>Edit
                    </td>
                    </tr>
                    @endforeach
                </table>
            </div>
                
        </div>
    </div>
</div>
@endsection
