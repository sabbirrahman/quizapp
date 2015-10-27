<?php namespace Models\App;

use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $table = 'quizzes';

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
