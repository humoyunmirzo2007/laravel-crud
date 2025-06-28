<?php

namespace App\Http\Helpers;

class Response
{
    public static function success(?string $message = null, $data = null, ?int $status = 200)
    {
        $response = [];

        if ($message !== null) {
            $response['message'] = $message;
        }

        $response['success'] = true;

        if ($data !== null) {
            $response['data'] = $data;
        }

        return response()->json($response, $status);
    }


    public static function error(string $message, $status = 400)
    {
        return response()->json([
            "message" => $message,
            "success" => false
        ], $status);
    }

    public static function notFoundError(string $message)
    {
        return response()->json([
            "message" => t("not_found", $message),
            "success" => false
        ], 404);
    }
}
