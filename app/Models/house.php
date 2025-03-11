<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory; // Add this

class House extends Model
{
    use HasFactory; // Include this

    protected $fillable = ['name', 'description', 'price', 'location'];
}