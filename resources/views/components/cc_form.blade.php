<form id="check-cc" class="px-8 pt-6 pb-8" action="#">
    <div class="mb-4">
        <label
            for="holder"
            class="block text-grey-dark text-sm font-bold mb-2 uppercase"
        >Name On Card</label
        >
        <input
            class="appearance-none border-b text-gery-dark py-2"
            name="cardholder"
            placeholder="Ex. Adi Gunawan"
            required
            type="text"
        />
    </div>
    <div class="mb-4">
        <label
            for="card"
            class="block text-grey-dark text-sm font-bold mb-2 uppercase"
        >Card number</label
        >
        <input
            class="appearance-none border-b text-grey-dark py-2"
            data-mask="0000 0000 0000 0000"
            maxlength="16"
            name="card_number"
            required
            type="text"
        />
        @if ($errors->any())
            <p class="text-red-500 text-xs italic">Please choose a password.</p>
        @endif
    </div>
    <div class="mb-4 flex justify-between">
        <div class="text-left pl-2">
            <div class="relative">
                    <span
                        class="block text-grey-dark text-sm font-bold mb-2 uppercase"
                    >Expiration Date</span
                    >
                <div class="flex items-center">
                    <div class="mr-2">
                        <select
                            name="expires_month"
                            id="month"
                            required
                            class="border-b appearance-none py-2 text-gery-dark bg-white"
                        >
                            @for($i=1; $i < 13; $i++)
                                <option value="{{ $i }}">{{ $i < 10 ? '0' . $i : $i }}</option>
                            @endfor
                        </select>
                    </div>
                    <span>/</span>
                    <div class="ml-2">
                        <select
                            name="expires_years"
                            required
                            id="years"
                            class="border-b appearance-none py-2 text-gery-dark bg-white"
                        >
                            @for($i=(\Carbon\Carbon::now())->year; $i < (\Carbon\Carbon::now()->year + 20); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center pr-2">
            <div class="relative">
                <label
                    for="cvc"
                    class="block text-grey-dark text-sm font-bold mb-2 uppercase"
                >cvc
                    <svg class="icon icon-sm icon-question hover:text-blue fill-current">
                        <use xlink:href="{{ asset('storage/images/symbol-defs.svg#icon-question') }}"></use>
                    </svg>
                </label
                >
                <input
                    id="cvc"
                    type="password"
                    name="cvc"
                    required
                    class="border-b appearance-none bg-white py-2 inline pl-2"
                    maxLength="3"
                    size="1"
                />
            </div>
        </div>
    </div>
    <div class="flex item-center justify-center mt-8">
        <validate-button></validate-button>
    </div>
</form>
