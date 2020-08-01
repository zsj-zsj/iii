<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class AttrModel extends Model
{
    public $primaryKey='attr_id';
    protected $table='shop_attr';
    public $timestamps=false;
    protected $guarded=[];
}
