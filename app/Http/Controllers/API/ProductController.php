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
    public function home(){
        $product = Product::orderBy('id','desc')->paginate(8);
        return response()->json($product,200);
    }
    public function showPhone(){
        $product = Product::with('category','location','user')->where('category_id','1')->where('choose',1)->orderBy('id','desc')->paginate(12);
        return response()->json($product,200);
    }
    public function showHomeLaptop(){
        $product = Product::with('category','location','user')->where('category_id','2')->where('choose',1)->orderBy('id','desc')->paginate(12);
        return response()->json($product,200);
    }
    public function showHomeIpad(){
        $product = Product::with('category','location','user')->where('category_id','6')->where('choose',1)->orderBy('id','desc')->paginate(12);
        return response()->json($product,200);
    }
    public function showHomeAccessory(){
        $product = Product::with('category','location','user')->where('category_id','4')->where('choose',1)->orderBy('id','desc')->paginate(12);
        return response()->json($product,200);
    }
    public function showIphone(){
        $product = Product::with('category','location','user')->where('category_id','1')->where('choose',1)->where('phone_id',1)->orderBy('id','desc')->paginate(8);
        return response()->json($product,200);
    }
    public function showSamSung(){
        $product = Product::with('category','location','user')->where('category_id','1')->where('choose',1)->where('phone_id',3)->orderBy('id','desc')->paginate(8);
        return response()->json($product,200);
    }
    public function showLaptop(){
        $product = Product::with('category','location','user')->where('category_id','2')->where('choose',1)->orderBy('id','desc')->paginate(8);
        return response()->json($product,200);
    }
    public function showIpad(){
        $product = Product::with('category','location','user')->where('category_id','6')->where('choose',1)->orderBy('id','desc')->paginate(8);
        return response()->json($product,200);
    }
    public function showByID($id){
        $product = Product::with('category','location','user','accessory','phone','laptop')->where('choose','1')->findOrFail($id);
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product,
            ],200);
        } 
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }

    public function showLocationID($id){
        $product = Product::where('location_id',$id)->where('choose','1')->get();
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
    public function showPhoneID($id){
        $product = Product::where('phone_id',$id)->where('choose','1')->get();
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
    public function showPricePhone($index){
        if($index == 1){
            $product = Product::whereBetween('price', ['1000000', '3000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index ==2){
            $product = Product::whereBetween('price', ['3000000', '5000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index ==3){
            $product = Product::whereBetween('price', ['5000000', '8000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index == 4){
            $product = Product::whereBetween('price', ['8000000', '10000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index == 5){
            $product = Product::whereBetween('price', ['10000000', '12000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index == 6){
            $product = Product::whereBetween('price', ['12000000', '15000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index == 6){
            $product = Product::whereBetween('price', ['15000000', '18000000'])->where('category_id','1')->where('choose','1')->get();
        }
        if($index == 6){
            $product = Product::whereBetween('price', ['15000000', '18000000'])->where('category_id','1')->where('choose','1')->get();
        }

        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }

    }

    public function showLaptopID($id){
        $product = Product::where('laptop_id',$id)->where('choose','1')->get();
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
    }
    
    public function showAccessoryID($id){
        $product = Product::where('accessory_id',$id)->where('choose','1')->get();
        if($product){
            return response()->json([
                'status' => 200,
                'product' => $product,
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Not found ID',
            ],404);
        }
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
            'title'=> 'required|max:190',
            'price'=> 'required|numeric',
            'number'=> 'required|numeric',
            'status'=> 'required',
            'choose'=> 'required|numeric',
            'description' => 'required',
            'category_id'  => 'required',
            'location_id'  => 'required',
            'file1' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'file2' => 'required',
            'file3' => 'required',
            'file4' => 'required',
            'color'=> 'required',
            'capacity' => 'required',
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
