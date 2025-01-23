<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    use HasFactory; // Enables factory support for the Todo model

    // Protects against mass assignment vulnerabilities; allows all fields to be mass assignable
    protected $guarded = [];
}
