<?php

namespace App\Model\Index;

use Illuminate\Database\Eloquent\Model;

class HistoryModel extends Model
{
    public $primaryKey='history_id';
    protected $table='u_history';
    public $timestamps=false;
    protected $guarded=[];
}
