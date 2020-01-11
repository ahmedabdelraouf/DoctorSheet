<?php

namespace App\Models;

use App\Models\BaseModel;

class Category extends BaseModel {

    protected $connection = 'mongodb';
    protected $fillable = ['name', 'description'];

}
