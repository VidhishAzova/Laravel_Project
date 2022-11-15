<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Orders extends Model
{
    use SoftDeletes;
    public $timestamps = true;
    protected $table='orders';
    protected $primaryKey = 'oid';
    protected $fillable=[];

}
