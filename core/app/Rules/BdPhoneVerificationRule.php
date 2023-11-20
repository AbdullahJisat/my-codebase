<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class BdPhoneVerificationRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pattern = "/^(?:\+88|88)?(01[3-9]\d{8})$/";
        if (!preg_match($pattern, $value)) {
            $fail('The :attribute number is not valid. Please enter a valid Bangladeshi phone number.');
        }
    }
}
