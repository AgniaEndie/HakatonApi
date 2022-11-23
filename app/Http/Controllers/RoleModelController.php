<?php

namespace App\Http\Controllers;

use App\Models\RoleModel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RoleModel::all();

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
                $rolemodel = new RoleModel();
                $rolemodel->role_name = $request->role_name;
                $rolemodel->role_status = $request->role_status;
                $rolemodel->save();

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
     * @param \App\Models\RoleModel $roleModel
     * @return \Illuminate\Http\Response
     */
    public function show(RoleModel $roleModel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\RoleModel $roleModel
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $rolemodel = RoleModel::find($id);
            if ($rolemodel) {
                $rolemodel->role_name = $request->role_name;
                $rolemodel->role_status = $request->role_status;
                $rolemodel->update();
                $data = [
                    'user' => Auth::user()->getAuthIdentifier(),
                    'role_name' => $rolemodel->role_name,
                    'role_status' => $request->role_status,
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
     * @param \App\Models\RoleModel $roleModel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, RoleModel $roleModel)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\RoleModel $roleModel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $user = User::query()->where("id_user", Auth::user()->getAuthIdentifier())->first();
        if ($user->id_role === 2) {

            $rolemodel = RoleModel::find($id);
            if ($rolemodel) {
                $rolemodel->delete();
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
