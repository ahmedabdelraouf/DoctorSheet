<?php

namespace App\Models;

use App\Models\BaseModel;

class WorkPlace extends BaseModel {

    protected $connection = 'mongodb';
    protected $fillable = ['name'];

}
