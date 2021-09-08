<?php

namespace App\Http\Controllers;

use App\Services\ResponseFormat;
use Exception;
use Illuminate\Support\Facades\Log;
use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use ResponseFormat;

    /**
     * Should log error - Sends a System Failure response if app is in Production or show a raw error message to developer on Development
     *
     * @return Illuminate\Http\Response
     */
    public static function manageError(Exception $error, $whereItHappened) {
        $errorMessage = $error->getMessage();
        Log::error("\n\n\nA new Error Just Occurred as follows:");
        Log::error("\n\n\n$whereItHappened");
        Log::error($errorMessage);
        if (env('APP_STAGE') == 'development') {
           dd($errorMessage);
        }

        return self::returnSystemFailure();
    }
}
