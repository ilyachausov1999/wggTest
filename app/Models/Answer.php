<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    public $table = 'answers';
    protected $fillable =
        [
            'answer',
            'question_id',
        ];

    public function questions()
    {
        return $this->belongsTo(Question::class, );
    }
}
