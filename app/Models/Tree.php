<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tree extends Model
{
    use HasFactory;
    protected $fillable = [
        'farm_id',
        'desc',
        'reason',
        'quantity',
        'date_planted',
    ];


    public function farm(){
        return $this->belongsTo(Farm::class, 'farm_id');
    }
}
