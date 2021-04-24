<?php

if (! function_exists('rules')) {
    /**
     * Create validator rules list
     */
    function rules(...$validators): array
    {
        return Spe11\LaravelValidator\Validator::make(...$validators)->toArray();
    }
}

if (! function_exists('field')) {
    /**
     * Create validator for field
     */
    function field(string $field): Spe11\LaravelValidator\FieldRules
    {
        return Spe11\LaravelValidator\Validator::for($field);
    }
}
