<?php

namespace App\Http\Controllers\Api\V1;


use App\CreditCard;
use App\Enums\CardType;
use App\Http\Resources\Card as CardResorce;
use App\Http\Resources\CardType as CardTypeResource;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\CreditCardNumber;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class CardController extends Controller
{
  /*
   * Validating CreditCard Number and return information about the card
   * like provider and other info
   * */
  public function identify(Request $request)
  {
    $cardNumber = $request->get('card_number');


    $validator = Validator::make($request->all(), [
      'card_number' => ['required', new CreditCardNumber()]
    ]);

    if ($validator->fails()) {
      $errors = array_map(function ($error) {
        return [
          'success' => 0,
          'source' => ['url_query' => 'card_number'],
          'message' => $error
        ];
      }, $validator->errors()->messages());
      return response()->json($errors, Response::HTTP_BAD_REQUEST);
    }

    return response()->json([
      'data' => ["CardNumber" => $cardNumber, "Provider" => CardTypeResource::make(CardType::identifyType($cardNumber))],
      'success' => 1
    ]);
  }

  public function index()
  {
    return CardResorce::collection(CreditCard::all()->sortBy('expired_at'));
  }


  public function store(Request $request)
  {
    try {
      $card = CreditCard::create($request->only(['cardholder', 'card_number', 'expires_in', 'cvc']));
      return new CardResorce($card);
    }catch (QueryException $e)  {
      return response()->json(["error"=> $e->errorInfo], Response::HTTP_SERVICE_UNAVAILABLE);
    }
  }

  public function update(Request $request, CreditCard $card): CardResorce
  {
    $card->update($request->only(['cardholder', 'card_number', 'expires_in', 'cvc']));
    return new CardResorce($card);
  }

  public function show(CreditCard $card): CardResorce
  {
    return new CardResorce($card);
  }

  public function destroy(CreditCard $card): Response
  {
    $card->delete();

    return response()->noContent();
  }
}
