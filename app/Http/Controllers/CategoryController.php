<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return CategoryResource::collection(Category::get());
    }

    public function store(Request $request)
    {
        $validator=Validator::make($request->all(),[
            'name'=>'required',
        ]);

        if($validator->fails())  return response()->json([
            'type' => 'error',
            'message' => 'Error in Add Category',
            'error' => $validator->errors(),
        ]);
        $category = Category::create($request->all());
        return CategoryResource::collection($category);
    }

    public function show($id)
    {
        return CategoryResource::collection(Category::where(['id'=>$id])->get());
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
        ]);

        if($validator->fails())
            return response()->json([
            'type' => 'error',
            'message' => 'Error in Update Category',
            'error' => $validator->errors(),
        ]);
        $category = Category::where(['id'=>$id])->first();
        if(!$category){
            return response()->json([
                'type' => 'error',
                'message' => 'Category not found'
            ]);
        }
        $category->update($request->all());
        return CategoryResource::collection($category->where(['id'=>$id])->get());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category=Category::where(['id'=>$id])->first();
        if(!$category){
            return response()->json([
                'type' => 'error',
                'message' => 'Category not found'
            ]);
        }
        $category->delete();
        return response()->json([
            'type' => 'success',
            'message' => 'Category deleted'
        ]);
    }
}
