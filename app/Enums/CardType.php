<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CardType extends Enum
{
    const V = 0;
    const MC = 1;
    const AXP = 2;
    const Unknown = 3;

  public static function getDescription($value): string
  {
    switch ($value) {
      case self::V:
        return 'Visa Classic';
        break;
      case self::MC:
        return 'MasterCard';
        break;
      case self::AXP:
        return 'American Express';
        break;
      default:
        return self::getKey($value);
    }
  }

  /**
   * @param String $cardNumber
   * @return int
   */
  public static function identify(String $cardNumber) : int {
    $cardTypes = [
      self::V => "/^4[0-9]{12}(?:[0-9]{3})?$/",
      self::MC => "/^(?:5[1-5][0-9]{2}|222[1-9]|22[3-9][0-9]|2[3-6][0-9]{2}|27[01][0-9]|2720)[0-9]{12}$/",
      self::AXP => "/^3[47][0-9]{13}$/"
    ];

    foreach ($cardTypes as $flag => $pattern) {
      if (preg_match($pattern, $cardNumber)) {
        return $flag;
      }
    }

    return self::Unknown;
  }

  public static function identifyType(String $cardNumber) : CardType {
    return self::getInstance(self::identify($cardNumber));
  }
}
