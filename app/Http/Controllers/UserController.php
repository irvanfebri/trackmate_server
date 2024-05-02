<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //data user company A => HRD company A
    // data user company B = > HRD company B

    public function index(Request $request) {
       $current_user = Auth::user();

       $query = User::where('company_id', $current_user->company_id);

       // menerapkan sort jika paramater sort_field dan sort_type tersedia
       if ($request->has('sort_field') && $request->has('sort_type')) {
        $sortField = $request->sort_field;
        $sortDirection = $request->sort_type;

        $query->orderBy($sortField, $sortDirection);
       }

       //menentukan jumlah data perhalaman (limit)
       $limit = $request->has('limit')? $request->limit : 10;


       //mengambil data dengan pembatas jumlah menggunakan paginate
       $users = $query->paginate($limit);

       return response()->json(['users' => $users], 200);

       //mengambil data dengan pembatas jumlah menggunakan paginate
       $users = $query->paginate(10);

       return response()->json(['users' => $users], 200);

    }

    public function store (Request $request)
    {
        $validator = Validator::make($request->all(),
        [
            'name' =>'required',
            'email' =>'required|email|unique:users',
            'password' => 'required',
            'role' =>'required',
            'status' => 'required',

        ]);

        $current_user = Auth::user();
        $company_id = $current_user->company_id;
        $request->merge(['company_id' => $company_id]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $data = $request->all();
        $data["company_id"] = $company_id;
        $user = User::create($data);
        return response()->json(['user' => $user], 201);
    }

    public function show($id) {

        $current_user = Auth::user();
        $company_id = $current_user->company_id;

        $user = User::where(
            "id",
            $id,
        )->where("company_id", $company_id)->first();


        if(!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        return response()->json(['user' => $user], 200);
    }

    public function update(Request $request, $id) {

        $current_user = Auth::user();
        $company_id = $current_user->company_id;

        $validator = Validator::make($request->all(),[

        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $user = User::where(
            "id",
            $id,
        )->where("company_id", $company_id)->first();

        if (!$user) {
            return response()->json(['error' => 'User not found'], 404);
        }

        $data = $request->all();
        $data["company_id"] = $company_id;
        $user->update($data);
        return response()->json(['user' => $user], 200);
    }

    public function destroy($id) {

        $current_user = Auth::user();
        $company_id = $current_user->company_id;

        $user = User::where(
            "id",
            $id,
        )->where("company_id", $company_id)->first();

    $user = User::find($id);
    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }
    $user->delete();
    return response()->json(['message' => 'User deleted Succesfully'], 200);
    }
}
