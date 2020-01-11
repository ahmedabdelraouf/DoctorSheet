<?php

namespace App\Http\Controllers\Business;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

class CategoryBusiness extends Controller {

    protected function getValidator($request, $flag) {
        $id = null;
        if (isset($request->all()['id'])) {
            $id = $request->all()['id'];
        }
        if ($flag == 'store') {
            $rules = [
                'name' => 'required|unique:categories',
                'description' => 'required',
//                'user_id' => 'required'
            ];
        } else if ($flag == 'getUserCategories') {
            $rules = [
//                'user_id' => 'required',
            ];
        } else if ($flag == 'getCategoryInfo') {
            $rules = [
//                'user_id' => 'required',
                'id' => 'required|exists:categories,id'
            ];
        } else if ($flag == 'delete') {
            $rules = [
                'id' => 'required|exists:categories,id',
//                'user_id' => 'required'
            ];
        } else if ($flag == 'update') {
            $rules = [
                'name' => 'required|unique:Categories,name,' . $id . ',_id',
                'description' => 'required',
//                'user_id' => 'required',
                'id' => 'required|exists:categories,id'
            ];
        }
        return Validator::make($request->post(), $rules);
    }

    public function storeCategory($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
//        $data['item'] = null;
        $validator = $this->getValidator($request, 'store');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            $category = new Category();
            $newCategory = $category->create($request->all());
            $data['status'] = ('success');
            $data['msg'] = ('success');
            $data['item'] = $newCategory;
        }
        return $data;
    }

    public function deleteCategory($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'delete');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            $category = Category::find($request->all()['id']);
//            dd($request->all()['id'], $category);
            if ($category != null) {
                if ($category->delete()) {
                    $data['status'] = ('success');
                    $data['msg'] = ('Category Removed succefully!');
                } else {
                    $data['msg'] = ('Something went wrong please try later !');
                }
            } else {
                $data['msg'] = ('Category not found!');
            }
        }
        return $data;
    }

    public function updateCategory($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'update');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            $category = Category::find($request->all()['id']);
            if ($category->update($request->all())) {
                $data['status'] = ('success');
                $data['msg'] = ('success');
                $data['item'] = $category;
            } else {
                $data['msg'] = ('Something went wrong please try later !');
            }
            return $data;
        }
    }

    public function getUserCategories($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'getUserCategories');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            //add where condition user_id equal to user_id from authentication
            $categories = Category::all();
            $data['status'] = ('success');
            $data['msg'] = ('success');
            $data['list'] = $categories->toArray();
            return $data;
        }
    }

    public function getCategoryInfo($request) {
        $data['status'] = ('fail');
        $data['msg'] = ('fail');
        $validator = $this->getValidator($request, 'getCategoryInfo');
        if ($validator->fails()) {
            $data['msg'] = $validator->errors()->all();
            return $data;
        } else {
            //TODO add where condition user_id equal to user_id from authentication
            $category = Category::find($request->all()['id']);
            if ($category != null) {
                $data['status'] = ('success');
                $data['msg'] = ('success');
                $data['item'] = $category;
            } else {
                $data['msg'] = ('Category not found!');
            }
            return $data;
        }
    }

    //
}
