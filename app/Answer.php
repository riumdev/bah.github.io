<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    protected $table = "answer";

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function question() {
    	return $this->hasOne("App\Question");
    }
}
