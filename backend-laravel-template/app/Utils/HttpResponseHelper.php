<?php

namespace App\Utils;

use Exception;
use Illuminate\Support\Facades\Log;

class HttpResponseHelper
{
    public static function responseSuccess($data = [], $statusCode = 200)
    {
        return response()->json($data, $statusCode);
    }

    public static function responseNoContent($statusCode = 204)
    {
        return response()->json([], $statusCode);
    }

    public static function responseBadRequest($errors, $statusCode = 400)
    {
        return response()->json([
            'message' => 'ValidationError',
            'type' => 'ValidationError',
            'errors' => $errors,
            'code' => $statusCode,
        ], $statusCode);
    }

    public static function responseUnauthorized($statusCode = 401)
    {
        return response()->json([
            'message' => 'Unauthenticated',
            'code' => $statusCode,
        ], $statusCode);
    }

    public static function responseForbidden($statusCode = 403)
    {
        return response()->json([
            'message' => 'Forbidden',
            'code' => $statusCode,
        ], $statusCode);
    }

    /**
     * Response structure json success.
     *
     * @param  array  $data  Data return
     * @param  int  $statusCode  Status code 2xx : 200, 201
     * @return Illuminate\Http\Response response data json
     */
    public static function responseNotFound($message = 'Not Found', $statusCode = 404)
    {
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
        ], $statusCode);
    }

    /**
     * responseServerError
     *
     * @param  Exception  $exception  exception
     * @return mixed
     */
    public static function responseServerError(Exception $exception, $statusCode = 500)
    {
        Log::error($exception);
        $message = $exception->getMessage();

        // if (config('app.debug')) { // todo
        //     $message = 'Internal Server Error';
        // }
        return response()->json([
            'message' => $message,
            'code' => $statusCode,
            'errors' => $exception->getTraceAsString(),
        ], $statusCode);
    }
}
