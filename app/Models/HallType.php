<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HallType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function hall(){
        return $this->belongsTo(Hall::class, 'id', 'halltype_id');
    }

}