<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Log;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function index($request){
        $logs = Log::where('host_id', $request)->get();
        $host = Host::find($request);
        return view('HostLogView')->with('host', $host)->with('logs', $logs);
    }
}
