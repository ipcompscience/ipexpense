<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'source', 'description', 'date'];

    protected $casts = [
        'date' => 'date', // Cast date field to date
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
