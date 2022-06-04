<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Helper;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class Categorys extends Controller
{
    public function add(Request $request)
    {
      if (!$request->get('nama_kategori')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  
      $data = array(
        'category_name' => $request->get('nama_kategori')
      );

      $category = Category::create($data);

      if (!!$category) {
          return Helper::generalResponse('00', 'Success', ['insert success']);
        }else{
          return Helper::generalResponse('01', 'Insert category failed', []);
      }
    }

    public function edit(Request $request)
    {
      if (!$request->get('id_kategori')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  
      $data = array(
        'category_name' => $request->get('nama_kategori')
      );

      $category = Category::where('category_id', $request->get('id_kategori'))->update($data);

      if (!!$category) {
          return Helper::generalResponse('00', 'Success', ['Update success']);
        }else{
          return Helper::generalResponse('01', 'Update category failed', []);
      }
    }

    public function delete(Request $request)
    {
      if (!$request->get('id_kategori')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  
      $data = array(
        'category_name' => $request->get('nama_kategori')
      );

      $category = Category::where('category_id', $request->get('id_kategori'))->delete();

      if (!!$category) {
          return Helper::generalResponse('00', 'Success', ['Delete success']);
        }else{
          return Helper::generalResponse('01', 'Delete category failed', []);
      }
    }

    public function getAllCategory(Request $request)
    { 
      $category = Category::get()->all();

      if (!!$category) {
          return Helper::generalResponse('00', 'Success', $category);
        }else{
          return Helper::generalResponse('01', 'Data not Found', []);
      }
    //   test git
    }

    public function getDetailCategory(Request $request)
    { 
      $category = Category::where('category_id', $request->get('id_kategori'))->first();

      if (!!$category) {
          return Helper::generalResponse('00', 'Success', [$category]);
        }else{
          return Helper::generalResponse('01', 'Data not Found', []);
      }
    //   test git
    }
}
