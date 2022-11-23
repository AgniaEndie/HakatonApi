<?php

namespace App\Http\Controllers;

use App\Models\AnswerModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnswerModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AnswerModel::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {
            $answer = new AnswerModel();
            $answer->answer = $request->answer;
            $answer->id_question = $request->id_question;
            $answer->save();

            $data = [
                'user' => Auth::user()->getAuthIdentifier(),
                'status' => 'ok',
                'user 1' => $user
            ];
            return response()->json($data, 201);
        }else{
            $data = [
                'message' => 'permission denied',
                'status' => 'failed'
            ];
            return response()->json($data, 301);
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
     * @param  \App\Models\AnswerModel  $answerModel
     * @return \Illuminate\Http\Response
     */
    public function show(AnswerModel $answerModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnswerModel  $answerModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {
            $answer= AnswerModel::find($id);
            if($answer){
                $answer->answer = $request->answer;
                $answer->id_question = $request->id_question;
                $answer->update();
                $data = [
                    'user'=>Auth::user()->getAuthIdentifier(),
                    'answer'=>$answer->answer,
                    'id_question'=>$answer->id_question,
                    "status"=>'ok',
                    "id"=>$id
                ];
                return response()->json($data, 200);
            }
            $data = [
                'user' => Auth::user()->getAuthIdentifier(),
                'status' => 'ok',
                'user 1' => $user
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message"=>"Access Denied",
                "code"=>403
            ];
            return response()->json($data, 403);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AnswerModel  $answerModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AnswerModel $answerModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnswerModel  $answerModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {
            $answer= AnswerModel::find($id);
            if($answer){
                $answer->delete();
                $data = [
                    'user'=>Auth::user()->getAuthIdentifier(),
                    "status"=>'ok',
                    "id"=>$id
                ];
            }
            $data = [
                'user'=>Auth::user()->getAuthIdentifier(),
                'message'=>"item is null",
                "status"=>'failed',
                "id"=>$id
            ];
            return response()->json($data, 200);
        }else{
            $data = [
                "message"=>"Access Denied",
                "code"=>403
            ];
            return response()->json($data, 403);
        }
    }
}
