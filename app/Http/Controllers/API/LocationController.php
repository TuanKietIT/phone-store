<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Location;

class LocationController extends Controller
{
    public function index(){
        $location = Location::orderBy('id','desc')->get();
        return response()->json($location,200);
    }
    public function showId($id){
        $location = Location::find($id);
        return response()->json( $location);
    }
    public function create(Request $request){
        $location = Location::create([
            'name' => $request->name,
        ]);
        if($location ){
            return response()->json([
                'status' => 200,
                'message' => 'Location create sucessfully',
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
