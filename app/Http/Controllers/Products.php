<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Helper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class Products extends Controller
{
    public function add(Request $request)
    {
      if (!$request->get('nama_produk')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  
      $data = array(
        'user_id'         => $request->get('id_user'),
        'category_id'     => $request->get('id_kategori'),
        'product_code'    => $request->get('kode_produk'),
        'product_name'    => $request->get('nama_produk'),
        'description'     => $request->get('keterangan'),
        'price'           => $request->get('harga'),
        'stock'           => $request->get('stok'),
        'image'           => $request->get('gambar'),
        'product_status'  => $request->get('status_produk')
      );

      $validator = \Validator::make($data, [
        'user_id'         => 'required',
        'category_id'     => 'required',
        'product_code'    => 'required|unique:product',
        'product_name'    => 'required|unique:product',
        'description'     => 'required',
        'price'           => 'required',
        'stock'           => 'required',
        'image'           => 'required',
        'product_status'  => 'required',
        ],
      );

      if ($validator->fails()) {
          return Helper::generalResponse('01', 'Insert product failed - '.$validator->errors()->first(), []);
          exit;
      }

      $product = Product::create($data);

      if (!!$product) {
          return Helper::generalResponse('00', 'Success', ['insert success']);
        }else{
          return Helper::generalResponse('01', 'Insert product failed', []);
      }
    }

    public function edit(Request $request)
    {
      if (!$request->get('id_produk')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  

      $data = array(
        'category_id'     => $request->get('id_kategori'),
        'product_code'    => $request->get('kode_produk'),
        'product_name'    => $request->get('nama_produk'),
        'description'     => $request->get('keterangan'),
        'price'           => $request->get('harga'),
        'stock'           => $request->get('stok'),
        'image'           => $request->get('gambar'),
        'product_status'  => $request->get('status_produk')
      );

      $validator = \Validator::make($data, [
        'category_id'     => 'required',
        'product_code'    => 'required|unique:product',
        'product_name'    => 'required|unique:product',
        'description'     => 'required',
        'price'           => 'required',
        'stock'           => 'required',
        'image'           => 'required',
        'product_status'  => 'required',
        ],
      );

      if ($validator->fails()) {
        return Helper::generalResponse('01', 'Insert product failed - '.$validator->errors()->first(), []);
        // exit;
      }

      $product = Product::where('product_id', $request->get('id_produk'))->update($data);

      if (!!$product) {
          return Helper::generalResponse('00', 'Success', ['Update success']);
        }else{
          return Helper::generalResponse('01', 'Update product failed', []);
      }
    }

    public function delete(Request $request)
    {
      if (!$request->get('id_produk')) {
          return Helper::generalResponse('01', 'Unknown request', []);
          exit;
      }  
      $product = Product::where('product_id', $request->get('id_produk'))->delete();

      if (!!$product) {
          return Helper::generalResponse('00', 'Success', ['Delete success']);
        }else{
          return Helper::generalResponse('01', 'Delete product failed', []);
      }
    }

    public function getAllProduct(Request $request)
    { 
      $product = Product::get()->all();

      if (!!$product) {
          return Helper::generalResponse('00', 'Success', $product);
        }else{
          return Helper::generalResponse('01', 'Data not Found', []);
      }
    //   test git
    }

    public function getDetailProduct(Request $request)
    { 
      $product = Product::where('product_id', $request->get('id_produk'))->first();

      if (!!$product) {
          return Helper::generalResponse('00', 'Success', [$product]);
        }else{
          return Helper::generalResponse('01', 'Data not Found', []);
      }
    //   test git
    }
}
