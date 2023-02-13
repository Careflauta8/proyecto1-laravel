<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    public function getDescriptionAttribute($value){
        return substr($value, 1, 120); //se utiliza para 
        //especificar el tamaño de la descripcion
    }
}
