<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Network extends Model
{
    use HasFactory;
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'edited_at';

    protected $fillable = [
        'id',
        'created_at',
        'edited_at',
        'net_addr',
        'netmask',
        'broadcast_addr',
        'acthost',
        'maxhost',
        'created_by',
        'edited_by'
    ];

    public function hosts()
    {
        return $this->hasMany(Host::class, 'network_id');
    }

    public function updateAnzHosts()
    {
        $anz_hosts = $this->hosts()->count('network_id', $this->id);
        $this->acthost = $anz_hosts;
        $this->save();
    }

    public function updateMaxHosts()
    {
        $varCounter = 32 - $this->netmask;
        $varCounter = pow(2,$varCounter) - 2;
        $this->maxhost = $varCounter;
        $this->save();
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function editor(){
        return $this->belongsTo(User::class,'edited_by');
    }

}
