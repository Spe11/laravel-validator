<?php

namespace Spe11\LaravelValidator;

use InvalidArgumentException;

class Rules
{
    private $rules = [];

    public function __construct(...$validators)
    {
        foreach ($validators as $validator) {
            if (!($validator instanceof FieldRules)) {
                throw new InvalidArgumentException('Invalid rules class');
            }

            $this->rules[$validator->field] = $validator->rules;
        }
    }

   public function toArray()
   {
       return $this->rules;
   }
}
