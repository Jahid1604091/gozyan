<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RoomDetail extends Model
{
    use HasFactory;
    protected $guarded = []; 
    public $timestamps = false;
    
    public function property(){
        return $this->belongsTo(Property::class);
    }
}
