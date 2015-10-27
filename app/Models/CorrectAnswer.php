<?php namespace Models\App;

use Illuminate\Database\Eloquent\Model;

class CorrectAnswer extends Model
{
    protected $table = 'correctanswers';

    public function question() {
    	return $this->belongsTo('App\Models\Question');
    }

    public function option() {
    	return $this->belongsTo('App\Models\Option');	
    }
}
