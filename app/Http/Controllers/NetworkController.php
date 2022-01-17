<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
class NetworkController extends Controller
{
    public function index(){
        $networks = Network::all();
        foreach ($networks as $network)
        {
            $network->updateAnzHosts();
        }
        return view('network.index', ['networks' => $networks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('network.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'netaddr' => [
                    'required',
                    'regex:/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/'
                ],
                'netmask' => [
                    'required',
                    'max:2',
                    'regex:/^[0-9]$|^[1-2][0-9]$|^3[0-1]$/'
                ],
            ]
        );

        $maxhost = pow(2,32-$request['netmask'])-2;
        $broadcast =  long2ip(ip2long($request['netaddr']) + $maxhost + 1);

        $network = new Network(
            [
                'net_addr' => $request['netaddr'],
                'netmask' => $request['netmask'],
                'acthost' => 0,
                'maxhost' => $maxhost,
                'broadcast_addr' => $broadcast,
                'created_by' => auth()->id(),
                'edited_by' => auth()->id()
            ]
        );

        $network->save();

        return redirect('/network');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $network = Network::findorfail($id);
        return view('network.edit', ['network' => $network]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate(
            [
                'netaddr' => [
                    'required',
                    'regex:/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/'
                ],
                'netmask' => [
                    'required',
                    'max:2',
                    'regex:/^[0-9]$|^[1-2][0-9]$|^3[0-1]$/'
                ],
            ]
        );

        $network = Network::findorfail($id);

        $maxhost = pow(2,32-$request['netmask'])-2;
        $broadcast =  long2ip(ip2long($request['netaddr']) + $maxhost + 1);

        $network->update([
            'net_addr' => $request['netaddr'],
            'netmask' => $request['netmask'],
            'acthost' => 0,
            'maxhost' => $maxhost,
            'broadcast_addr' => $broadcast,
            'edited_by' => auth()->id()
        ]);

        $network->updateAnzHosts();


        return redirect('/network');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $network = Network::find($id);
        $oldAddr = $network->net_addr;
        $network->delete();
        return $this->index()->with(
            [
                'message_success' => "Das Netzwerk <b>" . $oldAddr . "</b> wurde gelöscht."
            ]
        );

    }

    public function export(Request $request){

        $network = Network::find($request->id);

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=export_network.csv",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );

        $columns = array('IP-Adresse', 'Hostname', 'Bemerkung', 'Status');

        $callback = function() use($network, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($network->hosts as $host) {
                $row['IP-Adresse'] = $host->address;
                $row['Hostname'] = $host->hostname;
                $row['Bemerkung'] = $host->note;
                $row['Status'] = $host->state;

                fputcsv($file, array($row['IP-Adresse'], $row['Hostname'], $row['Bemerkung'], $row['Status']));
            }

            fclose($file);
        };
        return response()->stream($callback, 200, $headers);
    }
}
