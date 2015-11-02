<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $fillable = ['title', 'date_time', 'duration', 'description'];

    public function questions() {
    	return $this->hasMany('App\Models\Question');
    }

    public function answers() {
    	return $this->hasMany('App\Models\Answer');
    }

	public function participants() {
    	return $this->belongsToMany('App\Models\Student');
    }    
}
