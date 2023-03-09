<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\Admin\User;
use App\Traits\HasJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use HasJsonResponse;

    public function show()
    {
        $user = Auth::user();
        if($user){
            return $this->jsonResponse([
                User::make($user)
            ]);
        }

        return $this->jsonResponse([], 'Unauthenticated', 401);
    }
}
