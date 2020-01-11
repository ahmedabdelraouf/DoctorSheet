<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\BusinessController;
use Illuminate\Support\Facades\Validator;
use App\Models\WorkPlace;

class WorkPlaceBusiness extends BusinessController {

    protected function getValidator($request, $flag) {
        if ($flag == 'store') {
            $rules = [
                'name' => 'required|unique:workplaces',
//                'user_id' => 'required'
            ];
        } else if ($flag == 'getUserWorkPlaces') {
            $rules = [
//                'user_id' => 'required',
            ];
        } else if ($flag == 'getWorkPlaceInfo') {
            $rules = [
//                'user_id' => 'required',
                'id' => 'required'
            ];
        } else if ($flag == 'delete') {
            $rules = [
//                'user_id' => 'required',
                'id' => 'required'
            ];
        } else if ($flag == 'update') {
            $id = null;
            if (isset($request->all()['id'])) {
                $id = $request->all()['id'];
            }
            $rules = [
                'name' => 'required|unique:work_places,name,' . $id . ',_id',
//                'user_id' => 'required',
                'id' => 'required'
            ];
        }
        return Validator::make($request->post(), $rules);
    }

    protected function updateValidator($request) {

    }

    public function storeWorkPlace($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
//        $data['item'] = null;
        $validator = $this->getValidator($request, 'store');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            $workPlace = new WorkPlace();
            $newWorkPlace = $workPlace->create($request->all());
            $data['status'] = ('success');
            $data['msg'] = ('success');
            $data['item'] = $newWorkPlace;
        }
        return $data;
    }

    public function deleteWorkPlace($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'delete');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            $workPlace = WorkPlace::find($request->all()['id']);
//            dd($request->all()['id'], $workPlace);
            if ($workPlace != null) {
                if ($workPlace->delete()) {
                    $data['status'] = ('success');
                    $data['msg'] = ('WorkPlace Removed succefully!');
                } else {
                    $data['msg'] = ('Something went wrong please try later !');
                }
            } else {
                $data['msg'] = ('WorkPlace not found!');
            }
        }
        return $data;
    }

    public function updateWorkPlace($request) {

        $data['status'] = ('fail');
        $data['msg'] = ('fail');

        $validator = $this->getValidator($request, 'update');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            $workPlace = WorkPlace::find($request->all()['id']);
            if ($workPlace != null) {
                $result = $workPlace->update($request->all());
                if ($result) {
                    $data['status'] = ('success');
                    $data['msg'] = ('success');
                    $data['item'] = $workPlace;
                } else {
                    $data['msg'] = ('Something went wrong please try later !');
                }
            } else {
                $data['msg'] = ('WorkPlace not found!');
            }
            return $data;
        }
    }

    public function getUserWorkPlaces($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'getUserWorkPlaces');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            //add where condition user_id equal to user_id from authentication
            $workplace = WorkPlace::all();
            $data['status'] = ('success');
            $data['msg'] = ('success');
            $data['list'] = $workplace->toArray();
            return $data;
        }
    }

    public function getWorkPlaceInfo($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'getWorkPlaceInfo');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            //TODO add where condition user_id equal to user_id from authentication
            $workPlace = WorkPlace::find($request->all()['id']);
            if ($workPlace != null) {
                $data['status'] = ('success');
                $data['msg'] = ('success');
                $data['item'] = $workPlace;
            } else {
                $data['msg'] = ('WorkPlace not found!');
            }
            return $data;
        }
    }

}
