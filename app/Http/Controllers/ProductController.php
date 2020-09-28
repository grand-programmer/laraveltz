<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductResource;
use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'category_id' => 'array|exists:category,id',
        ]);

        if($validator->fails())  return response()->json([
            'type' => 'error',
            'error' => $validator->errors(),
        ]);
        $categories=$request->get('category_id');
        return ProductResource::collection(Product::whereHas('categories', function ($query) use ($categories){
            if($categories)
            return $query->whereIn('category_id',array_values($categories));
        })->get());
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'category' => 'required|array|exists:category,id',
        ]);

        if($validator->fails())  return response()->json([
            'type' => 'error',
            'message' => 'Error in Add Product',
            'error' => $validator->errors(),
        ]);
        $product = Product::create($request->all());

        $product->categories()->attach($request->get('category'));
        return ProductResource::collection($product);
    }

    public function show($id)
    {
        return ProductResource::collection(Product::where(['id'=>$id])->with('categories')->get());
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
            'category' => 'required|array|exists:category,id',
        ]);

        if($validator->fails())  return response()->json([
            'type' => 'error',
            'message' => 'Error in Update Product',
            'error' => $validator->errors(),
        ]);
        $product = Product::where(['id'=>$id])->first();
        if(!$product){
            return response()->json([
                'type' => 'error',
                'message' => 'Product not found'
            ]);
        }
        $product->categories()->detach();
        $product->categories()->attach($request['category']);
        unset($request['category']);
        $product->update($request->all());
        return ProductResource::collection($product->where(['id'=>$id])->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::where(['id'=>$id])->first();
        if(!$product){
            return response()->json([
                'type' => 'error',
                'message' => 'Product not found'
            ]);
        }
        $product->categories()->detach();
        $product->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Product deleted'
        ]);
    }
}
