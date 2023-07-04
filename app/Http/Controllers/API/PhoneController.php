<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use Illuminate\Support\Facades\Validator;
class PhoneController extends Controller
{
    public function index(){
        $phone = Phone::orderBy('id','asc')->get();
        return response()->json($phone,200);
    }
    public function home(){
        $phone = Phone::orderBy('id','asc')->paginate(5);
        return response()->json($phone,200);
    }
    public function showId($id){
        $phone = Phone::find($id);
        return response()->json( $phone);
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
    
            Phone::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
     }
     public function update(Request $request,$id){
        $phone = Phone::find($id);
        if($phone){
            $phone->name = $request->input('name');
            $phone->update();
            return response()->json([
                'status' => 200,
                'message' => 'Phone update sucessfully',
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
        $phone = Phone::find($id);
        if($phone){
             $phone->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Phone delete sucessfully',
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
