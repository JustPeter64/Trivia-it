<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;

    // een antwoord kan juist of fout zijn (boolean)
    protected $fillable = ['answer', 'correct', 'question_id'];

    public function question()
    {
        return $this->belongsTo('App\Models\Question', 'question_id');
    }
}
