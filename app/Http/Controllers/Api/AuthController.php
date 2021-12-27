<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\User;

class AuthController extends BaseController
{
    public function login(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return $this->sendError('Usuário não autenticado', $validator->errors(), 401);
        }

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return $this->sendError(
                'Usuário não autenticado',
                ['email' => ['O E-mail e a Senha fornecidos não foram encontrados em nossos registros.']],
                401
            );
        }

        $token = $user->createToken('wcastro-app')->plainTextToken;

        $success = [
            'user' => $user,
            'token' => $token
        ];

        return $this->sendResponse($success, 'Usuário autenticado');
    }

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return $this->sendResponse([], 'Usuário deslogado');
    }
}
