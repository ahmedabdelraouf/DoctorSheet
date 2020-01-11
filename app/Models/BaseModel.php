<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;

class BaseModel extends Model {

    public function toArray() {
        $array = parent::toArray();
        $array['id'] = $this->id;
//        unset($array['_id']);
        return $array;
    }

}
