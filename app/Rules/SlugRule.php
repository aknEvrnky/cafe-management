<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SlugRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if (!preg_match('/^[a-z0-9-]+$/', $value)) {
            $fail('The :attribute must be a string with no spaces, non-ascii characters, and special characters.');
        }

        if (preg_match('/^-/', $value)) {
            $fail('The :attribute must not start with a hyphen.');
        }

        if (preg_match('/-$/', $value)) {
            $fail('The :attribute must not end with a hyphen.');
        }
    }
}
