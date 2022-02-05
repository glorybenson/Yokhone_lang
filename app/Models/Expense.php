<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'date',
        'desc',
        'amount',
        'employee_id',
        'farm_id',
    ];

    public function farm(){
        return $this->hasOne(Farm::class, 'id', 'farm_id');
    }

    public function employee(){
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
