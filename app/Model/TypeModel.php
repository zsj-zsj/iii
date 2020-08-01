<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    public $primaryKey='type_id';
    protected $table='shop_type';
    public $timestamps=false;
    protected $guarded=[];
}
