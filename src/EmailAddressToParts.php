<?php
declare(strict_types=1);

use \Exception;
use Kirilmaz\Validators\EmailValidator;

class EmailAddressToParts {
    public static function get($address = null) : object | bool {
        if (false === is_string($address)) {
            throw new Exception('Email address has to be valid string');
        }

        if (false === EmailValidator::validate($address)) {
            return false;
        }

        $parts = explode('@', $address);

        return (object)[
            'username' => $parts[0],
            'domain' => $parts[1]
        ];
    }
}