<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GoodsAttrModel extends Model
{
    public $primaryKey='goods_attr_id';
    protected $table='shop_goods_attr';
    public $timestamps=false;
    protected $guarded=[];
}
