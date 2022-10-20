<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Resources\UserResource;
use App\Models\User;

class UserController extends Controller
{
    public function create(Request $request)
    {
        $data = $request->input();
        $user = UserService::create($data['name'],$data['email'],$data['password'],$data['role']);

        return new UserResource(User::find($user->id));
    }
}
