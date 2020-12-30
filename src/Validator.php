<?php

namespace Spe11\LaravelValidator;

class Validator
{
    const EMAIL_RFC    = 'rfc';
    const EMAIL_STRICT = 'strict';
    const EMAIL_DNS    = 'dns';
    const EMAIL_SPOOF  = 'spoof';
    const EMAIL_FILTER = 'filter';

    public static function make(...$validators): Rules
    {
        return new Rules(...$validators);
    }

    public static function for(string $field): FieldRules
    {
        return new FieldRules($field);
    }
}
