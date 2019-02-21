<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Product;
use App\Http\Controllers\Controller;
use Validator;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $products = Product::all();
      return $products;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:10',
            'body' => 'required|max:500',
            'image' => 'required',
            'price' => 'required',

        ]);
        if ($validator->fails()) {
            return response()->json(['文字数が多すぎます'],400);
        }
        $product = new Product;
        $product->title = $request->title;
        $product->body = $request->body;
        $product->image = $request->image;
        $product->price = $request->price;
        $product->save();
        return Product::all();
    }

    /**
     * Display the specified resource.ß
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $product = Product::find($id);
      return $product;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
      $validator = Validator::make($request->all(), [
          'title' => 'required|max:100',
          'body' => 'required|max:500',
          'image' => 'required',
          'price' => 'required',
      ]);
      if ($validator->fails()) {
          return response()->json(['文字数が多すぎます'],400);
      }
      $product = Product::find($id);
      $product->title = $request->title;
      $product->body = $request->body;
      $product->image = $request->image;
      $product->price = $request->price;
      $product->save();
      return $product;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $product = Product::find($id);
      $product->delete();
      return redirect('api/products');
    }
}
