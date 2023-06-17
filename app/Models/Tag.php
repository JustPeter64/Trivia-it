<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    public function quizzes()
    {
        return $this->belongsToMany('App\Models\Quiz', 'quiz_tag', 'tag_id', 'quiz_id')
        ->withTimestamps();
        //quiz_tag is de pivot table
        //tag_id is de foreign key van de pivot table
        //quiz_id is de foreign key van de pivot table
    }
}
