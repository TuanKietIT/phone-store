<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(){
        $location = Location::orderBy('id','asc')->get();
        return response()->json($location,200);
    }
    public function home(){
        $location = Location::orderBy('id','asc')->paginate(5);
        return response()->json($location,200);
    }
    public function showId($id){
        $location = Location::find($id);
        return response()->json( $location);
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
    
            Location::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
     }
     public function update(Request $request,$id){
        $location = Location::find($id);
        if($location){
            $location->name = $request->input('name');
            $location->update();
            return response()->json([
                'status' => 200,
                'message' => 'Location update sucessfully',
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
         $location = Location::find($id);
         if($location){
             $location->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Location delete sucessfully',
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
