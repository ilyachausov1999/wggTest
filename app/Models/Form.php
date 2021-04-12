<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Form extends Model
{
    use HasFactory;

    public $table = 'forms';
    protected $fillable =
        [
            'name',
            'user_id',
        ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function questions()
    {
        return $this->hasMany(Question::class, 'form_id', 'id');
    }
}
