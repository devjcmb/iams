<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;

class BaseController extends Controller
{
    protected $logData;

    /**
     * Success response method.
     *
     * @param array  $data    the processed data
     * @param string $message the success message
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendResponse($data, $message)
    {
        return response()->json(
            [
                'status' => true,
                'data' => $data,
                'message' => $message
            ], 
            200
        );
    }

    /**
     * Return error response.
     *
     * @param Exception $e       the error data
     * @param string    $message the error message
     * @param array     $data    additional data to be logged
     * @param integer   $code    the error code
     * 
     * @return \Illuminate\Http\Response
     */
    public function sendError($e, $message, $data, $code = 400)
    {
        Log::error("{$data['controller']}::{$data['method']} - {$e->getMessage()}");

        return response()->json(
            [
                'errors' => [
                    'message' => $message,
                ],
                'status' => false,
            ],
            $code
        );
    }
}
