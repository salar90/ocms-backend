<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\HasJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    use HasJsonResponse;

    public function register(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => ['required', Rule::unique('users', 'email')],
        ]);

        $user = User::query()->make([
            'name' => request('name'),
            'email' => request('email'),
        ]);
        $user->password = Hash::make(request('password'));
        $user->save();
        
        return $this->jsonResponse($user->toArray());
    }

    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only(['email', 'password']);

        $success = Auth::attempt($credentials, $request->input('remember'));
        
        if($success)
        {
            $user = Auth::user();
            $token = $user->createToken('api')->plainTextToken;

            return $this->jsonResponse([
                'user' => $user->only(['name', 'email']),
                'token' => $token
            ]);
        }else{
            return $this->jsonResponse([], 'invalid credentials', 401);
        }
    }

    public function logout()
    {
        Auth::logout();
        return $this->jsonResponse([]);
    }
}
