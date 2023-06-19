<?php
namespace App\Models;
use illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = ['title', 'description', 'user_id'];

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

    public function user() {
        return $this->belongsTo('App\Models\User');
    }

    //Dit is een Mutator
    public function setTitleAttribute($value) {
        $this->attributes['title'] = strtolower($value);
    }

    //Dit is een Accessor
    public function getTitleAttribute($value) {
        //Met ucfirst() zorg je ervoor dat de eerste letter van het eerste woord een hoofdletter wordt
        return ucfirst($value);
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

}