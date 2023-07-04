<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Laptop;
use Illuminate\Support\Facades\Validator; 

class LaptopController extends Controller
{
    public function index(){
        $laptop = Laptop::orderBy('id','asc')->get();
        return response()->json($laptop,200);
    }
    public function home(){
        $laptop = Laptop::orderBy('id','asc')->paginate(5);
        return response()->json($laptop,200);
    }
    public function showId($id){
        $laptop = Laptop::find($id);
        return response()->json( $laptop);
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
    
            Laptop::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
     }
     public function update(Request $request,$id){
        $laptop = Laptop::find($id);
        if($laptop){
            $laptop->name = $request->input('name');
            $laptop->update();
            return response()->json([
                'status' => 200,
                'message' => 'Laptop update sucessfully',
            ],200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => 'Something Went Wrong',
            ],404);
        }
     }
     public function delete(Request $request,$id)
     {
        $laptop = Laptop::find($id);
        if($laptop){
             $laptop->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Laptop delete sucessfully',
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
