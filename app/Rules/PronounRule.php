<?php

declare(strict_types=1);

namespace App\Rules;

use App\Enums\Pronouns;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class PronounRule implements ValidationRule
{
    /**
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return in_array(
            needle: $value,
            haystack: Pronouns::all(),
        );
    }

    /**
     * @return string
     */
    public function message()
    {
        return 'The pronoun selected is not valid.';
    }

    /**
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        
    }
}
