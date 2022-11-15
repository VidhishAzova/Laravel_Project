<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Availableproductcategory extends Model
{
    public $timestamps = true;
    use HasFactory;
    protected $primaryKey='pcid';
    protected $table='available_product_category';
}
