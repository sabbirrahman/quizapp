<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    protected $fillable = ['score', 'time', 'quiz_id', 'student_id'];

    public function student() {
    	return $this->belongsTo('App\Models\Student');
    }

    public function quiz() {
    	return $this->belongsTo('App\Models\Quiz');
    }
}
