<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = ['student_id', 'batch', 'department', 'user_id'];

    public function user() {
    	return $this->belongsTo('App\Models\User');
    }

    public function quizzes() {
    	return $this->belongsToMany('App\Models\Quiz');
    }

    public function answers() {
        return $this->hasMany('App\Models\Answer');
    }

    public function scores() {
    	return $this->hasMany('App\Models\Score');
    }
}
