<?php

namespace App\Http\Controllers;

use App\Models\Network;
use Illuminate\Http\Request;
use App\Models\Host;
use App\Http\Requests\UpdateHost;


class HostController extends Controller
{

    public function index($request){
        return view('ShowHostsView', ['host' => '']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $networks = Network::all();
        return view('host.create', ['networks' => $networks]);
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
                'hostname' => [
                    'required',
                    'max:255',
                ],
                'address' => [
                    'required',
                    'regex:/(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)/',
                    'unique:hosts,address'
                ],
                'note' => [
                    'max:255'
                ]
            ]
        );


        $host = new Host(
            [
                'hostname' => $request['hostname'],
                'address' => $request['address'],
                'note' => $request['note'],
                'network_id' => $request['network_id'],
                'state' => 'Down',
                'created_by' => auth()->id(),
                'edited_by' => auth()->id()
            ]
        );

        $host->save();

        return redirect('/network');
    }

    public function edit($hosts){
        $host = Host::findorFail($hosts);
        return view('host.editHost',['host' => $host]);
    }

    public function update(UpdateHost $request, $id){
        $host = Host::findorFail($id);


        $host -> update([
            'hostname' => $request->hostname,
            'note' => $request->note,
            'created_by' => auth()->id(),
            'edited_by' => auth()->id(),
        ]);

        session()->flash('success','Update erfolgreich');

        return redirect()->back();

    }
    public function delete($id){
        Host::find($id)->delete();
        session()->flash('success','Host erfolgreich gelöscht');
        return redirect('');
    }
}
