<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Area extends Model
{
    use HasFactory;
    protected $fillable = ['nome'];

    public static function lista_areas(){
        $lista_areas = Area::all()->sortBy('nome');
        return $lista_areas;
    }
}
