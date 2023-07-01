<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDiagnosesHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'issue_id',
        'name',
        'accuracy',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}