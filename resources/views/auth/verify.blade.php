@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8 pt-4">
            <div class="card">
                <div class="card-header">Verifizieren Sie Ihre E-Mail Adresse</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            Ein Verifizierungslink wurde an Ihre E-Mail Adresse gesendet.
                        </div>
                    @endif

                    Bitte prüfen Sie ob die Verifizierungsmail angekommen ist.
                    Falls Sie die E-Mail nicht erhalten haben,
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">klicken Sie hier um eine neue anzufordern.</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
