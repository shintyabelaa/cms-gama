@extends("frontend.layout")

@section("content")
    <div
        class="tw-flex tw-h-full tw-flex-col tw-items-center tw-justify-center tw-gap-16 tw-pb-5 tw-pt-9 tw-text-center"
    >
        <div class="tw-flex tw-items-center tw-gap-6">
            <a class="hover:tw-text-black" href="{{ route("frontend.welcome", ['table_no' => $table_no]) }}">
            <iconify-icon icon="ep:arrow-left-bold"></iconify-icon>
            </a>
            <h1 class="tw-text-xl tw-font-semibold">What They Say About Us</h1>
        </div>
        <div class="tw-flex tw-flex-col tw-gap-4">
            @foreach($reviews as $review)
                <div
                    class="tw-flex tw-h-[150px] tw-w-[346px] tw-flex-col tw-gap-2 tw-rounded-[10px] tw-bg-primary tw-p-3 tw-text-white"
                >
                    <div class="tw-flex tw-gap-3">
                        <div class="tw-h-12 tw-w-12 tw-rounded-full tw-bg-black"></div>
                        <div class="tw-flex tw-flex-col tw-gap-2">
                            <div class="tw-flex">
                                @for($i = 1; $i <= 5; $i++)
                                    <iconify-icon
                                        class="tw-text-lg {{ $i <= $review->ulasan_rating ? 'tw-text-yellow-500' : 'tw-text-white' }}"
                                        icon="ic:round-star"
                                    ></iconify-icon>
                                @endfor
                            </div>
                            <p class="tw-text-start tw-text-xs tw-font-bold">
                                {{ $review->customer->customer_nama }}
                            </p>
                        </div>
                    </div>
                    <p class="tw-text-justify tw-text-xs">
                        {{ $review->ulasan_deskripsi }}
                    </p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
