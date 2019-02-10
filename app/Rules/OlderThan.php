<?php

namespace App\Rules;

use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;

class OlderThan implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public $minAge;
    public function __construct($minAge)
    {
        $this->minAge = $minAge;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->minAge = ( ! empty($this->minAge)) ? (int) $this->minAge : 18;
        return (Carbon::parse($value)->age) >= $this->minAge;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The Worker must be older than '. $this->minAge .' years.';
    }
}
