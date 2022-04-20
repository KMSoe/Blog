<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public function sendResponse($meta, $data, $message, $status)
    {
        return response()->json([
            "success" => true,
            "meta" => $meta,
            "data" => $data,
            "message" => $message,
        ], $status);
    }

    public function sendError($errors, $message, $status)
    {
        return response()->json([
            "success" => false,
            "errors" => $errors,
            "message" => $message,
        ], $status);
    }
}
