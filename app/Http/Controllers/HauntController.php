<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Models\Haunt;
use Laravel\Lumen\Routing\Controller;

class HauntController extends Controller
{

    public function getHaunts(Request $request): JsonResponse
    {
        $haunts = Haunt::all()->toQuery()->simplePaginate();
        if (is_null($haunts)) {
            return response()->json('', 204);
        }
        return response()->json($haunts, 200);
    }

    public function show(int $id): JsonResponse
    {
        $haunt = Haunt::find($id);
        if (is_null($haunt)) {
            return response()->json('', 204);
        }
        return response()->json($haunt, 200);
    }

    public function getKeyword(Request $request): JsonResponse
    {
        $key = $request->input('keyword');
        $keywords = Haunt::all()->toQuery()
            ->where('description', 'like', "%$key%")
            ->paginate();

        if (is_null($keywords)) {
            return response()->json('', 204);
        }

        return response()->json($keywords, 200);
    }
}

