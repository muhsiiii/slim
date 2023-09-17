<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class admin_detail extends Authenticatable
{
    use HasFactory;

    protected $table='admin_details';
    protected $guarded=[];
   

   


}
