<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\BusinessController;

class ApiTokenBusiness extends BusinessController {

    public function createApiToken($userId) {
        $api_token = new Api_Token();
        $api_token->user_id = $userId;
        $api_token->api_token = \Hash::make(\Carbon\Carbon::now()->toRfc2822String() . $userId);
        if ($api_token->save()) {
            return $api_token;
        }
        return false;
    }

}
