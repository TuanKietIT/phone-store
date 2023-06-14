<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    public function index(){
        $menu = Menu::orderBy('id','asc')->get();
        return response()->json($menu,200);
    }
    public function home(){
        $menu = Menu::orderBy('id','asc')->paginate(5);
        return response()->json($menu,200);
    }
    public function showId($id){
        $menu = Menu::find($id);
        return response()->json( $menu);
    }
    public function create(Request $request){
        $menu = Menu::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);
        if($menu ){
            return response()->json([
                'status' => 200,
                'message' => 'Menu create sucessfully',
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
        $menu = Menu::find($id);
        if($menu){
            $menu->name = $request->input('name');
            $menu->url = $request->input('url');
            $menu->update();
            return response()->json([
                'status' => 200,
                'message' => 'Menu update sucessfully',
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
         $menu = Menu::find($id);
         if($menu){
             $menu->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Menu delete sucessfully',
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
