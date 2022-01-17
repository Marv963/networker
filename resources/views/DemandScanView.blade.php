{{-- Übergabeparameter: $result --}}
@extends('layouts.app')

@section('scripts')
    <script>
        function startscan() {
            var request = new XMLHttpRequest();
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    document.getElementById("startbtn").innerHTML = "Scan durchgeführt";
                    setTimeout(function(){
                        document.getElementById("startbtn").innerHTML = "Start ...";
                        document.getElementById("startbtn").disabled = false;
                    }, 3000);
                }
            };
            document.getElementById("startbtn").innerHTML = "<img src='{{ asset('img/loader.gif') }}'/>";
            document.getElementById("startbtn").disabled = true;
            request.open("GET", "/scan", true);
            request.send();
        }
    </script>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 pt-4">
                <div class="card">
                    <div class="card-header">Scan starten</div>
                    <div class="card-body text-center">
                        <button id="startbtn" class="btn btn-lg btn-success w-25" onclick="startscan()">Start ...</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
