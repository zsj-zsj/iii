<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class BrandModel extends Model
{
    public $primaryKey='brand_id';
    protected $table='shop_brand';
    public $timestamps=false;
    protected $guarded=[];
}
