<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lists extends Model
{
    use HasFactory;

    protected $fillable = [
        'list_name',
        'list_details',
        'status',
        'start_ymd',
        'end_ymd'
    ];
}
