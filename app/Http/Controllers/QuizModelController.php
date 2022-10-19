<?php

namespace App\Http\Controllers;

use App\Models\QuizModel;
use Illuminate\Http\Request;

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
        $data = $request->all();
        return print_r(data);
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
     * @param  \App\Models\QuizModel  $quizModel
     * @return \Illuminate\Http\Response
     */
    public function show(QuizModel $quizModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizModel  $quizModel
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizModel $quizModel)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizModel  $quizModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizModel $quizModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizModel  $quizModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizModel $quizModel)
    {
        //
    }
}
