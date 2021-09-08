<?php

namespace App\Http\Controllers;

use App\Services\DataHelper;
use App\Services\ResponseFormat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    use DataHelper, ResponseFormat;
    public function create(Request $request) {
        $validationError = self::validateRequest($request, self::$profileCreateValidationRule);
        if ($validationError != null) return self::returnFailed($validationError);

        try {
            // There won't be issues with unwanted fields because we already defined fillable fields
            $profile = Auth::user()->profile()->firstOrCreate($request->all());

            return self::returnSuccess($profile);
        } catch (Exception $error) {
            return self::manageError($error, __METHOD__);
        }
    }
}
