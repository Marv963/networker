<?php

namespace App\Http\Controllers;

use App\Models\Host;
use App\Models\Network;
use App\Models\Log;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log as Logger;

class ScanController extends Controller
{
    public function scanNetworks(){

        $networks = Network::all();

        foreach ($networks as $network){
            $broadcast = ip2long($network->broadcast_addr);
            $address = ip2long($network->net_addr);

            for($i=$address+1; $i<$broadcast; $i++){
                $ip = long2ip($i);
                $output = exec('ping -c 1 -w 1 ' . $ip);

                if($output != ''){
                    $host = Host::where('address', $ip)->first();
                    if($host){
                        if($host->state != "Up"){
                            $log = new Log();
                            $log->state = "Up";
                            $host->logs()->save($log);

                            $host->state = "Up";
                            $host->save();
                        }
                    }else{
                        $host = new Host();

                        $host->address = $ip;
                        $host->state = 'Up';
                        $network->hosts()->save($host);

                        $log = new Log();
                        $log->state = "Up";
                        $host->logs()->save($log);

                    }
                    //Logger::debug("IP: " . $ip . " Status: UP");
                }else{
                    $host = Host::where('address', $ip)->first();
                    if($host){
                        if($host->state != "Down"){
                            $log = new Log();
                            $log->state = "Down";
                            $host->logs()->save($log);

                            $host->state = "Down";
                            $host->save();
                        }
                    }
                    //Logger::debug("IP: " . $ip . " Status: DOWN");
                }
            }
        }

        return response()->json(['result' => 'success']);
    }

    public function index(){
        return view('DemandScanView');
    }

}
