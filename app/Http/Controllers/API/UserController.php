<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Client\ResponseSequence;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $input = $request->all();
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];

        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        }

        if (Auth::guard('user')->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $user = Auth::guard('user')->user();

            $token = $user->createToken('user token', ['user'])->accessToken;

            return response()->json(['user' => $user, 'token' => $token]);
        }
        // else {
        //     return response()->json(['error' => 'Invalid Credentials']);
        // }
    }

    public function getProfile()
    {
        $user = Auth::user();
        $token = $user->token();
        return response()->json(['user' => $user, 'token' => $token]);
    }

    public function logout()
    {
        $token = Auth::user()->token();
        DB::table('oauth_refresh_tokens')
            ->where('access_token_id', $token->id)
            ->update([
                'revoked' => true
            ]);

        $token->revoke();
        return response()->json(['success' => 'Logged out successfully.', 'token' => $token]);
    }
}
