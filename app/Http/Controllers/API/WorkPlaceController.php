<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Business\WorkPlaceBusiness;

class WorkPlaceController extends Controller {

    public function workPlaces(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $workPlaceBusiness = new WorkPlaceBusiness();
        $data = $workPlaceBusiness->getUserWorkPlaces($request);
        return response()->json($data);
    }

    public function getWorkPlaceInfo(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $workPlaceBusiness = new WorkPlaceBusiness();
        $data = $workPlaceBusiness->getWorkPlaceInfo($request);
        return response()->json($data);
    }

    public function store(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
//        $data = $this->authenticateUser($checkAuth = 1, $checkIsOwner = 1, $checkIsAdmin = 0);
//        if (is_null($data['item'])) {
//            return response()->json($data);
//        }
        $workPlaceBusiness = new WorkPlaceBusiness();
        $data = $workPlaceBusiness->storeWorkPlace($request);
        return response()->json($data);
    }

    public function update(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $workPlaceBusiness = new WorkPlaceBusiness();
        $data = $workPlaceBusiness->updateWorkPlace($request);
        return response()->json($data);
    }

    public function delete(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $workPlaceBusiness = new WorkPlaceBusiness();
        $data = $workPlaceBusiness->deleteWorkPlace($request);
        return response()->json($data);
    }

}
