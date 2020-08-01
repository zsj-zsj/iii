<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    public $primaryKey='role_id';
    protected $table='rbac_role';
    public $timestamps=false;
    protected $guarded=[];
}
