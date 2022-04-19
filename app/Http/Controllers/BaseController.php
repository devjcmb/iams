<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Throwable;

class BaseController extends Controller
{
    protected $logData;

    public function index(Request $request)
    {
        try {
            $result = $this->repo->index($request->user());

            if ($result instanceof Throwable) {
                throw new \Exception($result->getMessage());
            }

            return $this->sendResponse(
                $result, 
                'Data fetched successfully'
            );
        } catch (Throwable $e) {
            $this->logData['method'] = 'index';

            return $this->sendError(
                $e, 
                __('Failed to load data'),
                $this->logData
            );
        }   
    }

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
