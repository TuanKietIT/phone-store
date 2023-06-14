<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wiki;
use Illuminate\Support\Facades\Validator;
class WikiController extends Controller
{
    public function index(){
        $wiki = Wiki::with('jobWiki')->orderBy('id','asc')->get();
        return response()->json($wiki,200);
    }
    public function showId($id){
        $wiki = Wiki::find($id);
        return response()->json( $wiki);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'description' => 'required',
            'status' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'jobwiki_id'=> 'required',
       ]);
        if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
            }
    
            Wiki::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'Wiki create sucessfully',
            ],200);
        }
     }
     public function updateStatus(Request $request,$id){
        $status = Wiki::find($id);
        $validator = Validator::make($request->all(),[
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
                'status' => 'required',
            ]);
            $input = $request->all();
            $status->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'News update sucessfully',
            ],200);
        }
     }
     public function update($id, Request $request)
    {
        $wiki = Wiki::find($id);
        $validator = Validator::make($request->all(),[
            'description' => 'required',
            'status' => 'required',
            'jobwiki_id'=> 'required',
       ]);
       if($validator->fails()){
            return response()->json([
                'status' => 422,
                'errors' => $validator->messages(),
            ],422);
        }
        else{
            $request->validate([
                'description' => 'required',
                'status' => 'required',
                'file' => 'required',
                'jobwiki_id'=> 'required',
            ]);

            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
                unlink('img/'.$wiki->image);
            }
            
            $wiki->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'News update sucessfully',
            ],200);
        }
        
    }
     public function delete(Request $request,$id)
     {
         $wiki = Wiki::find($id);
         if($wiki){
             $wiki->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Wiki delete sucessfully',
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
