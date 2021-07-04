<?php
namespace App\Http\Controllers;

use App\Models\User;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TokenController extends Controller
{
    public function generateToken(Request $request)
    {
        $this->validate($request, [
            'email' => 'bail|required|email:rfc,dns',
            'password' => 'required|min:6'
        ]);
        $user = User::where('email', $request->email)->first();
        
        if (is_null($user)
            || !Hash::check($request->password, $user->password)
        ) {
            return response()->json('Username or password incorrect', 401);
        }

        $token = JWT::encode(
            ['email' => $request->email],
            env('JWT_KEY')
        );

        return [
            'access_token' => $token
        ];
    }
}
