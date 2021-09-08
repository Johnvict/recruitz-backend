<?php

namespace App\Http\Controllers\Profiles;

use Exception;
use Illuminate\Http\Request;

class WorkExperienceController extends ProfileController
{


    /**
     * Creates a new Work Experience Record for User - Job seeker
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     */
    public function createExperience(Request $request)
    {
        $validationError = self::validateRequest($request, self::$workExperienceCreateValidationRule);
        if ($validationError != null) return self::returnFailed($validationError);

        try {
            // There won't be issues with unwanted fields because we already defined fillable fields
            $request->merge(["user_id" => self::$user->id]);
            $workExperience = self::$user->profile->work_experiences()->firstOrCreate($request->all());

            return self::returnSuccess($workExperience);
        } catch (Exception $error) {
            return self::manageError($error, __METHOD__);
        }
    }

    /**
     * Updates existing Work Experience Record for User - Job seeker
     *
     * @param Illuminate\Http\Request
     * @return Illuminate\Http\Response
     */
    public function updateExperience(Request $request)
    {
        $validationError = self::validateRequest($request, self::$workExperienceUpdateValidationRule);
        if ($validationError != null) return self::returnFailed($validationError);

        try {
            // There won't be issues with unwanted fields because we already defined fillable fields
            $workExperience = self::$user->profile->work_experiences()->whereId($request->id)->first();
            if ($workExperience) {
                $workExperience->update($request->all());
                return self::returnSuccess($workExperience->refresh());
            }

            return self::returnNotFound();
        } catch (Exception $error) {
            return self::manageError($error, __METHOD__);
        }
    }
}
