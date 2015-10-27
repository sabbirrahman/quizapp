<?php namespace Models\App;

use Illuminate\Database\Eloquent\Model;

class Score extends Model
{
    protected $table = 'scores';

    public function student() {
    	return $this->belongsTo('App\Models\Student');
    }

    public function quiz() {
    	return $this->belongsTo('App\Models\Quiz');
    }
}