<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $table = "question";

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    public function answer(){
    	return $this->hasOne("App\Answer");
    }
}
