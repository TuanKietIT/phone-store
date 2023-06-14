<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Jobwiki;
 
class JobwikiController extends Controller
{
    public function index(){
        $jobWiki = Jobwiki::orderBy('id','asc')->get();
        return response()->json($jobWiki,200);
    }
    public function showId($id){
        $jobWiki = Jobwiki::find($id);
        return response()->json( $jobWiki);
    }
    public function create(Request $request){
        $jobWiki = Jobwiki::create([
            'name' => $request->name,
            'url' => $request->url,
        ]);
        if($jobWiki ){
            return response()->json([
                'status' => 200,
                'message' => 'Jobwiki create sucessfully',
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
        $jobWiki = Jobwiki::find($id);
        if($jobWiki){
            $jobWiki->name = $request->input('name');
            $jobWiki->url = $request->input('url');
            $jobWiki->update();
            return response()->json([
                'status' => 200,
                'message' => 'Jobwiki update sucessfully',
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
         $jobWiki = Jobwiki::find($id);
         if($jobWiki){
             $jobWiki->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Jobwiki delete sucessfully',
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
