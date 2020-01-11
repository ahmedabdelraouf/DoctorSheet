<?php

namespace App\Models;

use App\Models\BaseModel;

class ApiToken extends BaseModel {

    protected $connection = 'mongodb';

    public function user() {
        return $this->belongsTo('App\Models\user', 'user_id');
    }

}
