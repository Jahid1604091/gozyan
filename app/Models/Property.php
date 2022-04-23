<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
class Property extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    protected static function boot(){
        parent::boot();
        static::creating(function($property){
            $property->slug = Str::slug($property->name,'-');
        });
    }

}
