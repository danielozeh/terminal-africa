<?php
namespace DanielOzeh\TerminalAfrica\Traits;

/**
 * @author Daniel Ozeh hello@danielozeh.com.ng
 */

trait Response {
    public function response($status, $message, $status_code = null) {
        return response()->json([
            'status' => $status,
            'message' => $message
        ], $status_code);
    }

    public function sendSuccess($message, $data = [], $status_code = 200) {
        return response()->json([
            'status' => true,
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function sendError($message, $data = [], $status_code = 400) {
        return response()->json([
            'status' => false,
            'message' => $message,
            'data' => $data
        ], $status_code);
    }

    public function internalServerError($message, $status_code = 500) {
        return response()->json([
            'status' => false,
            'message' => $message,
        ], $status_code);
    }

    public function validationError($message) {
        return response()->json([
            'status' => false,
            $message
        ], 400);
    }
}