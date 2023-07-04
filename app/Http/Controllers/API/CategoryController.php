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
    public function home(){
        $category = Category::orderBy('id','asc')->paginate(5);
        return response()->json($category,200);
    }
    public function showId($id){
        $category = Category::find($id);
        return response()->json( $category);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=> 'required',
       ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $input = $request->all();
    
            Category::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
     }
     public function update(Request $request,$id){
         $validator = Validator::make($request->all(),[
             'name' => 'required',
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
                 $category->name = $request->input('name');
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
