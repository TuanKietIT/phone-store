<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Validator;
class NewsController extends Controller 
{
    public function index(){
        $news = News::orderBy('id','asc')->get();
        return response()->json($news,200);
    }
    public function home(){
        $news = News::orderBy('id','asc')->paginate(5);
        return response()->json($news,200);
    }
    public function showId($id){
        $news = News::find($id);
        return response()->json( $news);
    }
    public function create(Request $request){
        $validator = Validator::make($request->all(),[
            'title'=> 'required',
            'description' => 'required',
            'status' => 'required',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
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
    
            News::create($input);
            return response()->json([
                'status' => 200,
                'message' => 'News create sucessfully',
            ],200);
        }
     }
     public function updateStatus(Request $request,$id){
        $status = News::find($id);
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
        $news = News::find($id);
        $validator = Validator::make($request->all(),[
            'title'=> 'required',
            'description' => 'required',
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
                'title'=> 'required',
                'description' => 'required',
                'status' => 'required',
                'file' => 'required',
            ]);

            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
                unlink('img/'.$news->image);
            }
            
            $news->update($input);
            return response()->json([
                'status' => 200,
                'message' => 'News update sucessfully',
            ],200);
        }
        
    }
     public function delete(Request $request,$id)
     {
         $news = News::find($id);
         if($news){
             $news->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'News delete sucessfully',
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
