<?php

use App\Enums\CardType;

/**
 * Identify the flag of given card number
 * @param int $cardType
 * @return String
 */
function cardIcon(int $cardType)
{
  $baseUrl = asset('storage/images/symbol-defs.svg');
  switch ($cardType) {
    case CardType::V:
      $iconName = 'icon-visa';
      break;
    case CardType::MC:
      $iconName = 'icon-mastercard';
      break;
    case CardType::AXP:
      $iconName = 'icon-american-express';
      break;
    default:
      $iconName = 'icon-card-unknown';
  }
  return "$baseUrl#$iconName";
}

/**
 * Do checksum using [luhn algorithm](https://en.wikipedia.org/wiki/Luhn_algorithm) to validating card number
 * @param $number
 * @return Boolean
 */
function isValidCard(String $number)
{
    $digits = (string)$number;
    $total = strlen($digits);
    $sum = 0;

  for ($i = $total - 1; $i >= 0; $i -= 1) {
    // reverse index position
    $index = $total - $i + 1;
    if($index % 2 === 1) {
      // add to sum picked digit
      $sum += array_sum(str_split($digits{$i} * 2));
      continue;
    }
    $sum += $digits{$i};
  }

    return $sum % 10 == 0;
}
