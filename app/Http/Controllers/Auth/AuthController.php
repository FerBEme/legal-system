<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
class AuthController extends Controller {
    public function login(){
        $credentials = request()->only(['email','password']);
        if(!$token = Auth::guard('api')->attempt($credentials))
            return response()->json(['message' => 'Credenciales inválidas'],401);
        return $this->respondWithToken($token);
    }
    public function me(){
        $userAuth = Auth::guard('api')->user();
        return response()->json($userAuth);
    }
    public function refresh(){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        $newToken = $guard->refresh();
        return $this->respondWithToken($newToken);
    }
    public function logout(){
        Auth::guard('api')->logout();
        return response()->json(['message' => 'Sesión cerrada']);
    }
    private function respondWithToken($token){
        /** @var JWTAuth $guard */
        $guard = Auth::guard('api');
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer token',
            'expires_in' => $guard->factory()->getTTL() * 60,
        ]);
    }
}