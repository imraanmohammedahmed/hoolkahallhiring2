<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallNumber extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hall_type(){
        return $this->belongsTo(HallType::class,'hall_type_id');
    }


}