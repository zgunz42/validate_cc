<ul class="list-reset">
    <!-- card -->
    @foreach($cards as $card)
        <li class="py-2 border-b">
        @component('components/cc_item', ['issuingNetwork' => 'Visa Classic',
        'cardNumber' => $card->card_number, 'isValid' => true, 'iconName' => 'icon-visa'])@endcomponent
        </li>
    @endforeach
</ul>
