<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Enums\CardType;

class CreditCard extends Model
{
    protected $fillable = ['cardholder', 'card_number', 'expires_in', 'cvc'];

    public function setCardNumberAttribute($cardNumber) {
        $this-> type = CardType::identifyType($cardNumber);
        $this -> valid = isValidCard($cardNumber) && $this->type !== CardType::Unknown ? 1 : 0;
        $this->attributes['card_number'] = $cardNumber;
    }

    public function setTypeAttribute(CardType $cardType)
    {
      $this->attributes['type'] = $cardType->value;
    }

  public function getTypeAttribute() {
      return  CardType::getInstance($this->attributes['type']);
    }
}
