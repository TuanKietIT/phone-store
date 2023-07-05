<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index(){
        $product = Product::with('category','location','user')->orderBy('id','desc')->get();
        return response()->json($product,200);
    }
    public function showIphone(){
        $product = Product::with('category','location','user')->where('choose',1)->where('category_id',1)->orderBy('id','desc')->paginate(10);
        return response()->json($product,200);
    }
    public function showSamSung(){
        $product = Product::with('category','location','user')->where('choose',1)->where('category_id',2)->orderBy('id','desc')->paginate(10);
        return response()->json($product,200);
    }
    public function showByID($id){
        $product = Product::find($id);
        return response()->json( $product);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=> 'required|max:190',
            'price'=> 'required|numeric',
            'number'=> 'required|numeric',
            'status'=> 'required',
            'choose'=> 'required|numeric',
            'description' => 'required',
            'user_id'  => 'required',
            'category_id'  => 'required',
            'location_id'  => 'required',
            'file1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file2' => 'required',
            'file3' => 'required',
            'file4' => 'required',
            'color'=> 'required',
            'capacity' => 'required',
            'phone_id'  => 'required',
            'laptop_id'  => 'required',
            'accessory_id'  => 'required',
       ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $input = $request->all();
            $imageName1 = NULL;
            $imageName2 = NULL;
            $imageName3 = NULL;
            $imageName4 = NULL;
            if ($image1 = $request->file('file1')) {
                $destinationPath = 'img/';
                $imageName1 = Str::random(40) . "." . $image1->guessExtension();
                $image1->move($destinationPath, $imageName1);
                $input['image1'] = $imageName1;
            }
            if ($image2 = $request->file('file2')) {
                $destinationPath2 = 'img/';
                $imageName2 = Str::random(40) . "." . $image2->guessExtension();
                $image2->move($destinationPath2, $imageName2);
                $input['image2'] = $imageName2;
            }
            if ($image3 = $request->file('file3')) {
                $destinationPath = 'img/';
                $imageName3 = Str::random(40) . "." . $image3->guessExtension();
                $image3->move($destinationPath, $imageName3);
                $input['image3'] = $imageName3;
            }
            if ($image4 = $request->file('file4')) {
                $destinationPath = 'img/';
                $imageName4 = Str::random(40) . "." . $image4->guessExtension();
                $image4->move($destinationPath, $imageName4);
                $input['image4'] = $imageName4;
            }
            Product::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'Product create sucessfully',
            ],200);
        }
    }
     public function updateChoose(Request $request,$id){
        $status = Product::find($id);
        $validator = Validator::make($request->all(),[
            'choose' => 'required',
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $request->validate([
                'choose' => 'required',
            ]);
            $input = $request->all();
            $status->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'Product update sucessfully',
            ],200);
        }
     }
     public function update($id, Request $request)
    {
        $product = Product::find($id);
        $validator = Validator::make($request->all(),[
            'title'=> 'required',
            'description' => 'required',
            'status' => 'required',
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $request->validate([
                'title'=> 'required',
                'description' => 'required',
                'status' => 'required',
                'file' => 'required',
            ]);

            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
                unlink('img/'.$product->image);
            }
            
            $product->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'Product update sucessfully',
            ],200);
        }
        
    }
     public function delete(Request $request,$id)
     {
         $product = Product::find($id);
         if($product){
             $product->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Product delete sucessfully',
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
