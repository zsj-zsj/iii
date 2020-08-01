<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsModel extends Model
{
    public $primaryKey='goods_id';
    protected $table='shop_goods';
    public $timestamps=false;
    protected $guarded=[];
}
