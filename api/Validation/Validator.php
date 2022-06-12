<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/29/2022
 * File: Validator.php
 * Description: file contains validator class to validate state entries
 */

namespace UsDataAPI\Validation;
use Respect\Validation\Validator as v;
use Respect\Validation\Exceptions\NestedValidationException;

class Validator {
    private static array $errors = [];
    //Return the errors in an array
    public static function getErrors() : array {
        return self::$errors;
    }

    // A generic validation method. it returns true on success or false on failed validation.
    public static function validate($request, array $rules) : bool {
        foreach ($rules as $field => $rule) {
            //Retrieve parameters from URL or the request body
            $param = $request->getAttribute($field) ?? $request->getParsedBody()[$field];
            try{
                $rule->setName($field)->assert($param);
            } catch (NestedValidationException $ex) {
                self::$errors[$field] = $ex->getFullMessage();
            }
        }
        // Return true or false; "false" means a failed validation.
        return empty(self::$errors);
    }

    //Validate state data.
    public static function validateState($request) : bool {
        //Define all the validation rules
        $rules = [
//            'state_id' => v::notEmpty()->numericVal()->length(1, 5),
            'region' => v::numericVal(),
            'state_code' => v::alpha(' '),
            'state_name' => v::alpha(' '),
            'state_capital' => v::alnum(' '),
            'state_population' => v::numericVal(),
            'election' => v::numericVal()
        ];

        return self::validate($request, $rules);
    }


    public static function validateUser($request) : bool {
        $rules = [
            'name' => v::alnum(' '),
            'email' => v::email(),
            'username' => v::notEmpty(),
            'password' => v::notEmpty(),
            'role' => v::number()->between(1, 4)
        ];

        return self::validate($request, $rules);
    }

}