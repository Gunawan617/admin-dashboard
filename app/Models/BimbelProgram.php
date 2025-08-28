<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BimbelProgram extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'name',
        'category',
        'participants',
        'image',
        'description',
    ];
}
