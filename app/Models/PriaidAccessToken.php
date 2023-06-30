<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriaidAccessToken extends Model
{
    protected $table = 'priaid_access_tokens';

    protected $fillable = ['token','validThrough'];
}
