<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    public function index(){
        $category = Category::orderBy('id','desc')->get();
        return response()->json($category,200);
    }
    public function showId($id){
        $category = Category::find($id);
        return response()->json( $category);
    }
    public function create(Request $request){
        $category = Category::create([
            'title' => $request->title,
        ]);
        if($category ){
            return response()->json([
                'status' => 200,
                'message' => 'Category create sucessfully',
            ],200);
        }
        else{
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong',
            ],500);
        }
     }
     public function update(Request $request,$id){
         $validator = Validator::make($request->all(),[
             'title' => 'required',
        ]);
        if($validator->fails()){
             return response()->json([
                 'status' => 422,
                 'errors' => $validator->messages(),
             ],422);
         }
         else{
             $category = Category::find($id);
             if($category){
                 $category->title = $request->input('title');
                 $category->update();
                 return response()->json([
                     'status' => 200,
                     'message' => 'category update sucessfully',
                 ],200);
             }
             else{
                 return response()->json([
                     'status' => 404,
                     'message' => 'Something Went Wrong',
                 ],404);
             }
         }
     }
     public function delete(Request $request,$id)
     {
         $category = Category::find($id);
         if($category){
             $category->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'category delete sucessfully',
             ],200);
         }
         else{
             return response()->json([
                 'status' => 404,
                 'message' => 'Something Went Wrong',
             ],404);
         }
     }
}
