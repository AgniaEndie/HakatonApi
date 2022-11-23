<?php

namespace App\Http\Controllers;

use App\Models\QuizModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuizModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return QuizModel::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (isset($request)) {

            $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
            if ($user->id_role === 2) {
                $quiz = new QuizModel();
                $quiz->id_category = $request->id_category;
                $quiz->id_question = $request->id_question;
                $quiz->id_answer = $request->id_answer;
                $quiz->id_advice = $request->id_advice;
                $quiz->save();

                $data = [
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status' => 'ok',
                    'user 1' => $user
                ];
                return response()->json($data, 201);
            } else {
                $data = [
                    'message' => 'permission denied',
                    'status' => 'failed'
                ];
                return response()->json($data, 301);
            }

        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\QuizModel $quizModel
     * @return \Illuminate\Http\Response
     */
    public function show(QuizModel $quizModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\QuizModel $quizModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $quiz = QuizModel::find($id);
            if ($quiz) {
                $quiz->id_category = $request->id_category;
                $quiz->id_question = $request->id_question;
                $quiz->id_answer = $request->id_answer;
                $quiz->id_advice = $request->id_advice;
                $quiz->update();
                $data = [
                    'user' => Auth::user()->getAuthIdentifier(),
                    'category' => $quiz->id_category,
                    'question' => $quiz->id_question,
                    'answer' => $quiz->id_answer,
                    'advice' => $quiz->id_advice,
                    "status" => 'ok',
                    "id" => $id
                ];
                return response()->json($data, 200);
            }
            $data = [
                'user' => Auth::user()->getAuthIdentifier(),
                'status' => 'ok',
                'user 1' => $user
            ];
            return response()->json($data, 200);
        }
        $data = [
            "message" => "Access Denied",
            "code" => 403
        ];
        return response()->json($data, 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\QuizModel $quizModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizModel $quizModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\QuizModel $quizModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $quiz = QuizModel::find($id);
            if ($quiz) {
                $quiz->delete();
                $data = [
                    'user' => Auth::user()->getAuthIdentifier(),
                    "status" => 'ok',
                    "id" => $id
                ];
                return response()->json($data, 200);
            }
            $data = [
                'user' => Auth::user()->getAuthIdentifier(),
                'message' => "item is null",
                "status" => 'failed',
                "id" => $id
            ];
            return response()->json($data, 200);
        }
        $data = [
            "message" => "Access Denied",
            "code" => 403
        ];
        return response()->json($data, 403);
    }
}
