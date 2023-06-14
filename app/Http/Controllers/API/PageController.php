<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    public function index(){
        $page = Page::orderBy('id','asc')->get();
        return response()->json($page,200);
    }
    public function showId($id){
        $page = Page::find($id);
        return response()->json( $page);
    }
    public function create(Request $request){
        $page = Page::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);
        if($page ){
            return response()->json([
                'status' => 200,
                'message' => 'Page create sucessfully',
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
        $page = Page::find($id);
        if($page){
            $page->name = $request->input('name');
            $page->url = $request->input('url');
            $page->update();
            return response()->json([
                'status' => 200,
                'message' => 'Page update sucessfully',
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
         $page = Page::find($id);
         if($page){
             $page->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Page delete sucessfully',
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
