<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    protected $table = 'correctanswers';

    protected $fillable = ['question_id', 'option_id'];

    public function question() {
    	return $this->belongsTo('App\Models\Question');
    }

    public function option() {
    	return $this->belongsTo('App\Models\Option');	
    }
}
