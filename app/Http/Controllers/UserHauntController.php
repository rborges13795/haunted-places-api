<?php
namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Haunt;
use Illuminate\Http\JsonResponse;


class UserHauntController extends Controller
{
    public function getUserHaunts($id): JsonResponse
    {
        $user = User::find($id);
        if (is_null($user)) {
            return response()->json('', 204);
    }
        
        return response()->json($user->haunted, 200);
    }
    
    public function store($id, Request $request): JsonResponse
    {
        $user = User::find($id);
        $haunt = Haunt::find($request->haunted_id);
        
        if (is_null($user)) {
            return response()->json('User not found', 204);
        }
        
        if (is_null($haunt)) {
            return response()->json('Haunt not found', 204);
        }
        
        if (!$user->haunted()->save($haunt)) {
            return response()->json('Unable to store data', 500);
        }
        
        return response()->json('Haunt stored', 200);
        
    }
    
    public function remove($id, Request $request): JsonResponse
    {
        $user = User::find($id);
        $hauntId = $request->haunted_id;
        
        if (is_null($hauntId)) {
            return response()->json('Haunt not found', 204);
        }
        
        if (!$user->haunted()->detach($hauntId)) {
            return response()->json('Data not found. Check haunt id', 404);
        }
        
        return response()->json('Haunt removed', 200);
    }
}

