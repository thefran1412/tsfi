<?php
/**
 * Created by PhpStorm.
 * User: nico
 * Date: 18/04/2017
 * Time: 23:36
 */


use \Illuminate\Validation\Validator;
use Illuminate\Support\Facades\Hash;

class HashValidator extends Validator {

    public function validateHash($attribute, $value, $parameters) {
        return Hash::check($value, $parameters[0]);
    }
}