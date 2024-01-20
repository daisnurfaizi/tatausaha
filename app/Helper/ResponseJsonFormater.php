<?php

namespace App\Helper;

class ResponseJsonFormater
{

    /**
     * @var array
     */
    protected static $response = [
        'code' => 200,
        'status' => 'success',
        'message' => null,

    ];

    /**
     * @param null $data
     * @param null $message
     */
    public static function success($data = null, $message = null)
    {
        // if ($data) {
        self::$response['data'] = $data;
        // }
        self::$response['message'] = $message;

        return response()->json(self::$response, self::$response['code']);
    }

    public static function error($message = null, $code = 400)
    {
        self::$response['status'] = 'error';
        self::$response['message'] = $message;
        self::$response['code'] = $code;

        return response()->json(self::$response, self::$response['code']);
    }
}
