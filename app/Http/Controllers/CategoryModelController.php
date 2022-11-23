<?php

namespace App\Http\Controllers;

use App\Models\CategoryModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategoryModel::all();
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
                $category = new CategoryModel();
                $category->category = $request->category;
                $category->save();

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
     * @param \App\Models\CategoryModel $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\CategoryModel $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $category= CategoryModel::find($id);
            if($category){
                $categoryold = $category->category;
                $category->category = $request->category;
                $category->update();
                $data = [
                    'user'=>Auth::user()->getAuthIdentifier(),
                    'category'=>$categoryold,
                    'category_new'=>$request->category,
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

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\CategoryModel $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryModel $categoryModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\CategoryModel $categoryModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $category= CategoryModel::find($id);
            if($category){
                $category->delete();
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
