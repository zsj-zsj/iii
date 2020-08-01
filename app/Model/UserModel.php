<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $primaryKey='user_id';
    protected $table='rbac_user';
    public $timestamps=false;
    protected $guarded=[];
}
