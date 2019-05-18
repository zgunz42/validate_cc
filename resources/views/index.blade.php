@extends('layouts/app')

@section('content')
    <div class="flex justify-center bg-gery-light p-0 lg:py-10 lg:px-3">
        <div class="flex flex-wrap sm:flex-no-wrap justify-center shadow-md bg-white w-full lg:w-5/6 xl:w-3/5  rounded max-w-full">
            <div class="w-full sm:w-3/5">
                <div class="mb-4 scrollable">
                    <h2 class="text-2xl px-8 pt-6 pb-4">Payment Details</h2>
                    <card-form></card-form>
                </div>
            </div>
            <div class="w-full relative overflow-hidden left-divider">
                <h2 class="text-2xl bg-blue pb-4 text-white px-8 pt-6 scrollmin">Checked Cards</h2>
                <div class="container px-4 overflow-y-scroll" style="max-height: 360px">
                    <card-list></card-list>
                </div>
            </div>
        </div>
    </div>
@endsection
