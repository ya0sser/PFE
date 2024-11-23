<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
class Machine extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'brand', 
        'capacity', 
        'power', 
        'materials', 
        'image_path'
    ];
}
