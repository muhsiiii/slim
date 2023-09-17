<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class gym extends Model
{
    use HasFactory;
    protected $table='gyms';
    protected $guarded=[];

    public function GetAgent()
    {
        return $this->belongsTo(agent::class, 'agent_id', 'id');
    }
}
