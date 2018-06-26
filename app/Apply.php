<?php

namespace App;

use App\Model;

class Apply extends Model
{
    //
    public function user(){
        return $this->belongsTo("App\User");
    }
}
