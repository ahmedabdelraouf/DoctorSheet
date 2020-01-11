<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\APIController;
use Illuminate\Http\Request;
use App\Category;
use App\Http\Controllers\Business\CategoryBusiness;

class CategoryController extends APIController {

    public function index(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $CategoryBusiness = new CategoryBusiness();
        $data = $CategoryBusiness->getUserCategories($request);
        return response()->json($data);
    }

    public function getCategoryInfo(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $CategoryBusiness = new CategoryBusiness();
        $data = $CategoryBusiness->getCategoryInfo($request);
        return response()->json($data);
    }

    public function store(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
//        $data = $this->authenticateUser($checkAuth = 1, $checkIsOwner = 1, $checkIsAdmin = 0);
//        if (is_null($data['item'])) {
//            return response()->json($data);
//        }
        $CategoryBusiness = new CategoryBusiness();
        $data = $CategoryBusiness->storeCategory($request);
        return response()->json($data);
    }

    public function update(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $CategoryBusiness = new CategoryBusiness();
        $data = $CategoryBusiness->updateCategory($request);
        return response()->json($data);
    }

    public function delete(Request $request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $CategoryBusiness = new CategoryBusiness();
        $data = $CategoryBusiness->deleteCategory($request);
        return response()->json($data);
    }

}
