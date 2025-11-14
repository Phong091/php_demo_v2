<?php

namespace App\Containers\Auth\Http\Controllers\Api;

use App\Containers\Auth\Http\Requests\LoginRequest;
use App\Http\Controllers\Api\BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends BaseController
{
    public function login(LoginRequest $request)
    {
        $credentials = [
            'email' => $request->email,
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
