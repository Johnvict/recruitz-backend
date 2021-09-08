<?php

namespace App\Http\Controllers\Profiles;

use App\Http\Controllers\Controller;
use App\Services\DataHelper;
use App\Services\ResponseFormat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller {
    use DataHelper, ResponseFormat;
    public static $user;
    public function __construct()
    {
        self::$user = Auth::user();
    }

    /**
     * Creates a new Profile Record for User - Job seeker
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     */
    public function create(Request $request) {
        $validationError = self::validateRequest($request, self::$profileCreateValidationRule);
        if ($validationError != null) return self::returnFailed($validationError);

        try {
            // There won't be issues with unwanted fields because we already defined fillable fields
            $profile = self::$user->profile()->firstOrCreate($request->all());

            return self::returnSuccess($profile);
        } catch (Exception $error) {
            return self::manageError($error, __METHOD__);
        }
    }

    /**
     * Updates existing Profile Record for User - Job seeker
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     */
    public function update(Request $request) {
        $validationError = self::validateRequest($request, self::$profileCreateValidationRule);
        if ($validationError != null) return self::returnFailed($validationError);

        try {
            // There won't be issues with unwanted fields because we already defined fillable fields
            if (self::$user->profile) {
                self::$user->profile()->update($request->all());
                return self::returnSuccess(self::$user->profile->refresh());
            }

            return self::returnFailed("Sorry, you need to create a profile first");
        } catch (Exception $error) {
            return self::manageError($error, __METHOD__);
        }
    }
}
