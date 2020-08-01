<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PermModel extends Model
{
    public $primaryKey='permission_id';
    protected $table='rbac_permission';
    public $timestamps=false;
    protected $guarded=[];
}
