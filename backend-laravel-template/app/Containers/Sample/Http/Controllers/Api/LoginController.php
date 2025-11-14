<?php

namespace App\Containers\Sample\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $credentials = [
            'customer_login_id' => $request->email,
            'password' => $request->password,
        ];

        // Todo: Handle hasTooManyLoginAttempts
        if (Auth::attempt($credentials)) {
            $token = Auth::user()->createToken('API Token')->plainTextToken;

            return $this->responseSuccess(['access_token' => $token]);
        } else {
            throw ValidationException::withMessages([
                $this->username() => [trans('auth.failed')],
            ]);
        }
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'email';
    }
}
