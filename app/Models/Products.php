<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    public $timestamps = true;
    protected $table='products';
    protected $primaryKey = 'pid';
    use HasFactory;

}
