<?php

if (! function_exists('rules')) {
    /**
     * Create validator rules list
     */
    function rules(...$validators): array
    {
        return Validator::make(...$validators)->toArray();
    }
}

if (! function_exists('for')) {
    /**
     * Create validator for field
     */
    function field(string $field): FieldRules
    {
        return Validator::for($field);
    }
}