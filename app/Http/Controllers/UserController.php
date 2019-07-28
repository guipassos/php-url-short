<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        //
    }

    public function getUser(Request $request)
    {
        $data = $request->all();

        $email = isset($data['email']) ? $data['email'] : NULL;
        $password = isset($data['password']) ? $data['password'] : NULL;

        $user = User::where('email', $email)->first();
        if ($user){
            if (!empty($password) && Hash::check($password, $user->password)){
                return response($user);
            }
        }
        return response()->json(['message' => 'Invalid email or password'],401);
    }
}
