<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    Use HasFactory;

    protected $fillable = [
        'name',
        'link',
        'icon'
    ];
}
