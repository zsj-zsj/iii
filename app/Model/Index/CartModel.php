<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    public $primaryKey='cart_id';
    protected $table='u_cart';
    public $timestamps=false;
    protected $guarded=[];
}
