<?php

namespace App\Rules;

use App\Enums\CardType;
use Illuminate\Contracts\Validation\Rule;

class CreditCardNumber implements Rule
{
    protected $_message;
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if (CardType::identify($value) === CardType::Unknown) {
          $this->_message = 'Unknown Card Provider';
          return false;
        }
        if(!isValidCard($value)){
          $this->_message = 'Invalid Card Number';
          return false;
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Credit Card Is Not Valid';
    }
}
