<?php

namespace App\Interfaces\Http\Controllers;

use App\Infrastructure\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(Request $request){
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'Credenciales inválidas'], 401);
        }

        $token = $user->createToken('auth_token', [$user->role->name])->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role->name,
        ]);
    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();
        return response()->json(['message' => 'Sesión cerrada']);
    }

    /**
     * Redirige al login de Microsoft (SSO)
     */
    public function redirectToMicrosoft(){
        return Socialite::driver('microsoft')->redirect();
    }

    public function handleMicrosoftCallback(){
        $microsoftUser = Socialite::driver('microsoft')->user();
        $user = User::firstOrCreate(
            ['email' => $microsoftUser->getEmail()],
            [
                'name' => $microsoftUser->getName(),
                'role_id' => 4 // Asignamos el id 4, indicandole un rol operativo.
            ]
        );

        $token = $user->createToken('auth_token', [$user->role->name])->plainTextToken;

        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'role' => $user->role->name,
        ]);
    }
}
