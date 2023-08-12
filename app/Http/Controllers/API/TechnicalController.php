<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class TechnicalController extends Controller
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

        if (Auth::guard('technical')->attempt(['email' => $input['email'], 'password' => $input['password']])) {
            $technical = Auth::guard('technical')->user();

            $token = $technical->createToken('technical token', ['technical'])->accessToken;

            return response()->json(['technical' => $technical, 'token' => $token]);
        }
        // else {
        //     return response()->json(['error' => 'Invalid Credentials']);
        // }
    }

    public function getProfile()
    {
        $technical = Auth::user();
        $token = $technical->token();
        return response()->json(['technical' => $technical, 'token' => $token]);
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
