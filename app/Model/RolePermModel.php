<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePermModel extends Model
{
    public $primaryKey='rp_id';
    protected $table='rbac_rp';
    public $timestamps=false;
    protected $guarded=[];
}
