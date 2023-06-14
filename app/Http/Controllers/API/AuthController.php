<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use App\Models\User;
class AuthController extends Controller
{
    public function index(){ 
        $user = User::orderBy('id','desc')->get();
        return response()->json($user,200);
    }
    public function create(Request $request){
        try {
            //Validated
            $validator = Validator::make($request->all(),[
                'name' => 'required|max:50',
                'email' => 'required||email|unique:users,email',
                'password' => 'required|min:8|max:16',
                'c_password' =>'required|same:password',
                'phone' => 'required|max:11|min:10',
                'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ]);
            if($validator->fails()){
                $response = [
                    'status' => 422,
                    'errors' => $validator->errors()
                ];
                return response()->json($response, 422);
            }

            $input = $request->all();
            $imageName = NULL;
            if ($image = $request->file('file')) {
                $destinationPath = 'img/';
                $imageName = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath, $imageName);
                $input['image'] = $imageName;
            }
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);

            return response()->json([
                'status' => true,
                'message' => 'Tạo thành viên thành công',
            ], 200);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage()
            ], 500);
        }

    }

    public function login(Request $request){
        if(Auth::attempt(['email'=>$request->email,'password'=>$request->password])){
            $user = Auth::user();
            $success['token'] = $user->createToken('MyApp')->plainTextToken;
            $success['name'] = $user->name;

            $response = [
                'success' => true,
                'data' => $success,
                'message' => 'User login successfully'
            ];
            return response()->json($response,200);
        }else{
            $response = [
                'success' => false,
                'message' => 'Email & Password does not match with our record'
            ];
            return response()->json($response);
        }
    }
}
