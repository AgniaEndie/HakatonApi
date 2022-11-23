<?php

namespace App\Http\Controllers;

use App\Models\QuestionModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestionModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuestionModel::all();
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
            $question = new QuestionModel();
            $question->question = $request->question;
            $question->id_category = $request->id_category;
            $question->save();

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
     * @param  \App\Models\QuestionModel  $questionModel
     * @return \Illuminate\Http\Response
     */
    public function show(QuestionModel $questionModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuestionModel  $questionModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request,$id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {
            $question = QuestionModel::find($id);
            if($question){
                $questionold = $question->question;
                $id_category_old = $question->id_category;
                $question->question = $request->question;
                $question->id_category = $request->id_category;
                $question->update();
                $data = [
                    'user' => Auth::user()->getAuthIdentifier(),
                    'questionold'=>$questionold,
                    'questionnew'=>$question->question,
                    'id_category_old'=>$id_category_old,
                    'id_category_new'=>$question->id_category,
                    'status' => 'ok',
                    'user 1' => $user
                ];
                return response()->json($data, 201);
            }
        }else{
            $data = [
                'message' => 'permission denied',
                'status' => 'failed'
            ];
            return response()->json($data, 301);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuestionModel  $questionModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuestionModel $questionModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuestionModel  $questionModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $question= QuestionModel::find($id);
            if($question){
                $question->delete();
                $data = [
                    'user'=>Auth::user()->getAuthIdentifier(),
                    "status"=>'ok',
                    "id"=>$id
                ];
                return response()->json($data, 200);
            }
            $data = [
                'user'=>Auth::user()->getAuthIdentifier(),
                'message'=>"item is null",
                "status"=>'failed',
                "id"=>$id
            ];
            return response()->json($data, 200);
        }
        $data = [
            "message"=>"Access Denied",
            "code"=>403
        ];
        return response()->json($data, 403);
    }
    
}
