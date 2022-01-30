<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'date',
        'desc',
        'quantity',
        'unit_price',
        'total_price_before_discount',
        'discount',
        'total_price_after_discount',
        'crop_id',
        'farm_id',
    ];

    public function crop(){
        return $this->hasOne(Crop::class, 'id', 'crop_id');
    }

    public function farm(){
        return $this->hasOne(Farm::class, 'id', 'farm_id');
    }

    public function client(){
        return $this->hasOne(Client::class, 'id', 'client_id');
    }
}
