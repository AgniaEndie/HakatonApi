<?php

namespace App\Http\Controllers;

use App\Models\AdviceModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdviceModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return AdviceModel::all();
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
                $advice = new AdviceModel();
                $advice->advice_text = $request->advice_text;
                $advice->save();
                $data = [
                    'user' => Auth::user()->getAuthIdentifier(),
                    'status' => 'ok',
                    'user 1' => $user
                ];
                return response()->json($data, 200);
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
     * @param \App\Models\AdviceModel $adviceModel
     * @return \Illuminate\Http\Response
     */
    public function show(AdviceModel $adviceModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\AdviceModel $adviceModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $advice = AdviceModel::find($id);
            if ($advice) {
                $advice->advice_text = $request->advice_text;
                $advice->update();
            }
            $data = [
                'user'=>Auth::user()->getAuthIdentifier(),
                'advice'=>$advice->advice_text,
                "status"=>'ok',
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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\AdviceModel $adviceModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AdviceModel $adviceModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\AdviceModel $adviceModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $advice= AdviceModel::find($id);
            if($advice){
                $advice->delete();
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
