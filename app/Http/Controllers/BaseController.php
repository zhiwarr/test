<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;

//wrap controller in a base controller to maintain clean code
abstract class BaseController extends Controller
{
    protected function sendResponse($data): JsonResponse
    {
        return response()->json([
            'success' => true,
            'data' => $data
        ]);
    }

    protected function sendSuccess($message, $data = []): JsonResponse | RedirectResponse
    {
        $response = [
            'success' => true,
            'data'    => $data,
            'message' => $message,
        ];
        if (request()->expectsJson()) {
            return response()->json($response, 200);
        }

        return $this->redirectBack($message);
    }

    protected function redirectBack($message, $type = 'success'): RedirectResponse
    {
        return redirect()->back()->with($type, $message);
    }

    protected function sendError($error, $code = 404): JsonResponse | RedirectResponse
    {
        $response = [
            'success' => false,
            'message' => $error,
        ];

        if (request()->expectsJson()) {
            return response()->json($response, $code);
        }

        return redirect()->back()->with('error', $error);
    }
}