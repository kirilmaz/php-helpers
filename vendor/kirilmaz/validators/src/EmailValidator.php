<?php

namespace Kirilmaz\Validators;

class EmailValidator {
    public static function validate($email = null) : bool {
        if (false !== filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }

        return false;
    }
}