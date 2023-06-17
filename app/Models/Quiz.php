<?php
namespace App\Models;
use illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'content'];

    public function likes() {
        return $this->hasMany('App\Models\Like', 'quiz_id');
        //quiz_id is de foreign key
    }

    public function tags() {
        return $this->belongsToMany('App\Models\Tag', 'quiz_tag', 'quiz_id', 'tag_id')
        ->withTimestamps();
        //quiz_tag is de pivot table
        //quiz_id is de foreign key van de pivot table
        //tag_id is de foreign key van de pivot table
    }

    // public function questions()
    // {
    //     return $this->hasMany('App\Models\Question');
    // }

}