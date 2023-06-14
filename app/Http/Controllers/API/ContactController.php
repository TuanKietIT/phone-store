<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
class ContactController extends Controller
{
    public function index(){
        $contact = Contact::orderBy('id','desc')->get();
        return response()->json($contact,200);
    }
    public function showId($id){
        $contact = Contact::find($id);
        return response()->json( $contact);
    }
    public function create(Request $request){
        $contact = Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'title' => $request->title,
            'description' => $request->description,
        ]);
        if($contact ){
            return response()->json([
                'status' => 200,
                'message' => 'Contact create sucessfully',
            ],200);
        }
        else{
            return response()->json([
                'status' => 500,
                'message' => 'Something Went Wrong',
            ],500);
        }
     }
     public function delete(Request $request,$id)
     {
         $contact = Contact::find($id);
         if($contact){
             $contact->delete();
             return response()->json([
                 'status' => 200,
                 'message' => 'Contact delete sucessfully',
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
