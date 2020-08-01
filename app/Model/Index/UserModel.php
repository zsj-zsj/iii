<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class UserModel extends Model
{
    public $primaryKey='user_id';
    protected $table='users';
    public $timestamps=false;
    protected $guarded=[];
}
