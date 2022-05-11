<?php
declare(strict_types=1);

namespace Kirilmaz\Helpers;

use Kirilmaz\Validators\EmailValidator;

class EmailAddressToParts {
    public static function get($address = null) : object | bool {
        if (false === is_string($address)) {
            return false;
        }

        if (false === EmailValidator::validate($address)) {
            return false;
        }

        $parts = explode('@', $address);

        return (object) [
            'username' => $parts[0],
            'domain' => $parts[1]
        ];
    }
}