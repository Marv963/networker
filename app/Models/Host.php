<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Host extends Model
{
    use HasFactory;
    use SoftDeletes;
    const CREATED_AT = 'created_at';
    const UPDATED_AT = 'edited_at';

    protected $fillable = [
        'network_id',
        'hostname',
        'address',
        'note',
        'state',
        'created_by',
        'edited_by',
        'created_at',
        'edited_at',
        'deleted_at',
    ];

    public function logs()
    {
        return $this->hasMany(Log::class);
    }

    public function network()
    {
        return $this->belongsTo(Network::class);
    }

    public function creator(){
        return $this->belongsTo(User::class,'created_by');
    }

    public function editor(){
        return $this->belongsTo(User::class,'edited_by');
    }
}
