<div class="flex justify-center items-center">
    <div class="mr-4 relative" style="width: 56px">
        <svg class="icon w-full icon-visa border rounded-lg p-2">
            <use xlink:href="{{ asset("storage/images/symbol-defs.svg#$iconName") }}"></use>
        </svg>
        @if($isValid)
        <div
            class="absolute pin-b pin-r inline text-white bg-red-light p-1 rounded-full flex items-center justify-center"
            style="width: 20px; height: 20px">
            <svg class="icon icon-xs icon-cross align-middle">
                <use xlink:href="{{ asset("storage/images/symbol-defs.svg#icon-cross") }}"></use>
            </svg>
        </div>
            @else
            <div
                class="absolute pin-b pin-r inline text-white bg-green-light p-1 rounded-full flex items-center justify-center"
                style="width: 20px; height: 20px">
                <svg class="icon icon-xs icon-checkmark align-middle">
                    <use xlink:href="{{ asset("storage/images/symbol-defs.svg#icon-checkmark") }}"></use>
                </svg>
            </div>
        @endif
    </div>
    <div class="flex-1">
        <h4 class="card-name mb-3">{{ $issuingNetwork }}
        </h4>
        <p class="card-number tracking-wide">{{ $cardNumber }}</p>
    </div>
    <div class="w-2/6">
        <div class="inline-flex">
            <button class="bg-blue-light hover:bg-blue text-white font-bold py-2 px-4 rounded-l">
                Edit
            </button>
            <button class="bg-red-light hover:bg-red text-white font-bold py-2 px-4 rounded-r">
                Delete
            </button>
        </div>
    </div>
</div>
