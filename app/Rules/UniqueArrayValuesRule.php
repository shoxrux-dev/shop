<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class UniqueArrayValuesRule implements Rule
{
    public function passes($attribute, $value)
    {
        return count($value) === count(array_unique($value));
    }

    public function message()
    {
        return 'Each element in the :attribute array must be unique.';
    }
}
