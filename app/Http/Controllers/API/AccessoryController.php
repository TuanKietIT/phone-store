<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Accessory;
use Illuminate\Support\Facades\Validator;
class AccessoryController extends Controller
{
    public function index(){
        $accessory = Accessory::orderBy('id','asc')->get();
        return response()->json($accessory,200);
    }
    public function home(){
        $accessory = Accessory::orderBy('id','asc')->paginate(5);
        return response()->json($accessory,200);
    }
    public function showId($id){
        $accessory = Accessory::find($id);
        return response()->json( $accessory); 
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
    
            Accessory::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
     }
     public function update(Request $request,$id){
        $accessory = Accessory::find($id);
        if($accessory){
            $accessory->name = $request->input('name');
            $accessory->update();
            return response()->json([
                'status' => 200,
                'message' => 'Accessory update sucessfully',
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
         $accessory = Accessory::find($id);
         if($accessory){
             $accessory->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Accessory delete sucessfully',
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
