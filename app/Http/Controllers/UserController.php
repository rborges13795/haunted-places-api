<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function getUsers(Request $request): JsonResponse
    {
        $users = User::all()->toQuery()->simplePaginate();
        if (is_null($users)) {
            return response()->json('', 204);
        }
        return response()->json($users, 200);
    }

    public function show($id): JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json('', 204);
        }
        return response()->json($user, 200);
    }

    public function create(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            'email' => 'bail|required|email:rfc,dns|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        if ($validator->errors()->count()) {
            return response()->json($validator->errors(), 400);
        }

        $user = DB::table('users')->insert([
            'email' => $request->email,
            'password' => $request->password
        ]);

        if ($user) {
            return response()->json('User created', 200);
        }

        return response()->json('Unable to create user', 500);
    }

    public function remove($id): JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json('', 204);
        }

        if (! $user->delete()) {
            return response()->json('Unable to delete user', 500);
        }

        return response()->json('User deleted', 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json('', 204);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'bail|unique:users|email:rfc,dns'
        ]);

        if ($validator->errors()->count()) {
            return response()->json($validator->errors(), 400);
        }
        
        $user->email = $request->email;
        
        $user->save();
        
        return $user;
    }
}

