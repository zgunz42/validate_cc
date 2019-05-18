<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Card extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'cardNumber' => $this->card_number,
            'valid'=> !!($this->valid),
            'provider'=> CardType::make($this->type),
            'expires_in' => strtotime($this->expires_in),
            'holder'=> $this->cardholder
        ];
    }
}
