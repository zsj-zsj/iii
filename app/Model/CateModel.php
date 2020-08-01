<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class CateModel extends Model
{
    public $primaryKey='cate_id';
    protected $table='shop_cate';
    public $timestamps=false;
    protected $guarded=[];

    public static function getMenu()
    {
        $cate=CateModel::get();
        $cate=getCateInfo($cate);
        return $cate;
    }
}
