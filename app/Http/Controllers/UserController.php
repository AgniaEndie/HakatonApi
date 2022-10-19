<?php

namespace App\Http\Controllers;

use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Testing\Fluent\Concerns\Has;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        if(isset($request)){
            $user = new User();
            $user->name = $request->name;
            $user->age = $request->age;
            $user->email = $request->email;
            $user->phone = $request->phone;
            $user->password = $request->password;
            $user->id_role = $request->id_role;
            $user->api_token = Str::random(60);



            $user->save();
            $token = $user->createToken($user->api_token);

            $data = [
                "name"=>$user->name,
                "age"=>$user->age,
                "email"=>$user->email,
                "phone"=>$user->phone,
                "password"=>$user->password,
                "id_role"=>$user->id_role,
                "api_token"=>$token->plainTextToken,
            ];

            return \response()->json($data,201);
        }else{
            $data = [
              "status"=>"error",
              "code"=>"500"
            ];
            return \response()->json($data,500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {






        $user = User::where('phone',$request->phone)->orderBy('name')->get();
        $userId = $user[0]->id_user;
        $user = User::find($userId);
//        if(Hash::check($request->password,$user[0]->password)){
        if($request->password == $user->password){


            $user->api_token = Str::random(60);



            $token = $user->createToken($user->api_token);
            $token = $token->plainTextToken;


            $data = [
                "user"=>Auth::loginUsingId($userId),
                "token"=>$token
            ];
            return \response()->json($data,200);
        }else{
            $data = [
                "status"=>"unauthorised.",
                "code"=>403
            ];
            return \response()->json($data,403);
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
