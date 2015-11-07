<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $table = 'answers';

    protected $fillable = ['student_id', 'question_id', 'option_id'];

    public function question() {
    	return $this->belongsTo('App\Models\Question');
    }

    public function student() {
    	return $this->belongsTo('App\Models\Student');
    }

    public function option() {
    	return $this->belongsTo('App\Models\Option');
    }
}
