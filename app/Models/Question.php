<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = ['questions', 'type'];

    public function options() {
    	return $this->hasMany('App\Models\Option');
    }

    public function correctAnswers() {
    	return $this->hasMany('App\Models\CorrectAnswer');
    }

    public function answers() {
    	return $this->hasMany('App\Models\Answer');
    }

    public function quiz() {
    	return $this->belongsTo('App\Models\Quiz');
    }
}
