<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SkuModel extends Model
{
    public $primaryKey='prorduct_id';
    protected $table='shop_prorduct';
    public $timestamps=false;
    protected $guarded=[];
}
