@extends("frontend.layout")

@section("content")
    <div
        class="tw-flex tw-h-[100vh] tw-flex-col tw-justify-between tw-px-5 tw-pb-5 tw-pt-9 tw-text-center"
    >
        <div class="tw-flex tw-flex-grow tw-flex-col tw-gap-[30px]">
            <div class="tw-flex tw-items-center tw-justify-between tw-gap-8">
                <a
                    class="hover:tw-text-primary tw-text-primary"
                    href="{{ route("frontend.homepage.index", ["table_no" => $table_no, "customer_id" => $customer_id]) }}"
                >
                    <iconify-icon icon="ep:arrow-left-bold"></iconify-icon>
                </a>
                <h1 class="tw-text-xl tw-font-semibold">Your Bill</h1>
                <a
                    class="gap-2 tw-flex tw-items-center tw-justify-center tw-rounded-xl tw-border-2 tw-border-primary tw-px-4 tw-py-2 tw-font-bold tw-text-primary hover:tw-text-primary"
                    href="{{ route("frontend.homepage.index", ["table_no" => $table_no, "customer_id" => $customer_id]) }}"
                >
                    <iconify-icon
                        class="tw-text-lg"
                        icon="basil:plus-outline"
                    ></iconify-icon>
                    Add More
                </a>
            </div>

            <!-- Check if cart is empty -->
            @if ($cartItems->isEmpty())
                <!-- Display message if cart is empty -->
                <div class="tw-flex tw-text-center tw-text-lg tw-text-primary tw-font-bold tw-items-center tw-justify-center">
                    Anda tidak memiliki keranjang
                </div>
            @else
            <div class="tw-flex tw-w-full tw-items-center tw-justify-center">
                <ol class="tw-flex tw-w-full tw-items-center tw-justify-center">
                    <li class="tw-relative tw-mb-6 tw-w-full">
                        <div class="tw-flex tw-items-center tw-justify-center">
                            <div
                                class="tw-dark:bg-blue-900 tw-sm:ring-8 tw-dark:ring-gray-900 tw-absolute tw-z-10 tw-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-primary tw-ring-0 tw-ring-white"
                            >
                                <svg
                                    class="tw-dark:text-blue-300 tw-h-2.5 tw-w-2.5 tw-text-blue-100"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 16 12"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5.917L5.724 10.5L15 1.5"
                                    />
                                </svg>
                            </div>
                            <div
                                class="tw-dark:bg-gray-700 tw-absolute tw-left-1/2 tw-flex tw-h-0.5 tw-w-full tw-bg-gray-200"
                            ></div>
                        </div>
                    </li>
                    <li class="tw-relative tw-mb-6 tw-w-full">
                        <div
                            class="tw-relative tw-flex tw-items-center tw-justify-center"
                        >
                            <div
                                class="tw-dark:bg-blue-900 tw-sm:ring-8 tw-dark:ring-gray-900 tw-absolute tw-z-10 tw-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-gray-200 tw-ring-0 tw-ring-white"
                            >
                                <svg
                                    class="tw-dark:text-blue-300 tw-h-2.5 tw-w-2.5 tw-text-gray-900"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 16 12"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5.917L5.724 10.5L15 1.5"
                                    />
                                </svg>
                            </div>
                            <div
                                class="tw-dark:bg-gray-700 tw-flex tw-h-0.5 tw-w-full tw-bg-gray-200"
                            ></div>
                        </div>
                    </li>
                    <li class="tw-relative tw-mb-6 tw-w-full">
                        <div
                            class="tw-relative tw-flex tw-items-center tw-justify-center"
                        >
                            <div
                                class="tw-dark:bg-gray-700 tw-sm:ring-8 tw-dark:ring-gray-900 tw-absolute tw-z-10 tw-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-gray-200 tw-ring-0 tw-ring-white"
                            >
                                <svg
                                    class="tw-dark:text-white tw-h-2.5 tw-w-2.5 tw-text-gray-900"
                                    aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg"
                                    fill="none"
                                    viewBox="0 0 16 12"
                                >
                                    <path
                                        stroke="currentColor"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M1 5.917L5.724 10.5L15 1.5"
                                    />
                                </svg>
                            </div>
                            <div
                                class="tw-dark:bg-gray-700 tw-absolute tw-right-1/2 tw-flex tw-h-0.5 tw-w-full tw-bg-gray-200"
                            ></div>
                        </div>
                    </li>
                </ol>
            </div>
            <div class="tw-flex tw-flex-col tw-gap-5">
                <div
                    class="tw-flex tw-items-center tw-justify-between tw-rounded-lg tw-border-2 tw-border-[#C72F2F] tw-bg-[#FFCBCB] tw-px-2 tw-py-1 tw-text-[#5E5454]"
                >
                    <p class="tw-align-middle">Order Type</p>
                    <div
                        class="tw-flex tw-items-center tw-justify-center tw-gap-[10px] tw-align-middle"
                    >
                        <p>{{ $order_type }}</p>
                        <iconify-icon
                            class="tw-text-lg tw-text-[#41C767]"
                            icon="iconoir:badge-check"
                        ></iconify-icon>
                    </div>
                </div>
                <div
                    class="tw-flex tw-flex-col tw-gap-2 tw-rounded-[10px] tw-bg-primary tw-text-white"
                >
                    <div class="tw-flex tw-justify-between tw-gap-3 tw-p-3">
                        <div class="tw-flex tw-gap-5">
                            <img
                                class="tw-rounded-full"
                                width="53"
                                src="{{ asset("assets/images/gamalogoreal.jpg") }}"
                                alt=""
                            />
                            <div
                                class="tw-flex tw-flex-col tw-items-start tw-gap-1"
                            >
                                <h2
                                    class="tw-text-lg tw-font-bold tw-text-white"
                                >
                                    Rp{{ number_format($cartItems->sum(fn ($item) => $item->product->product_harga * $item->quantity), 0, ",", ".") }}
                                </h2>
                                <p class="tw-text-xs tw-text-[#D9D9D9]">
                                    Gama. Coffee House
                                </p>
                            </div>
                        </div>
                        <div
                            class="tw-flex tw-h-12 tw-w-12 tw-flex-col tw-items-center tw-justify-center tw-rounded-lg tw-bg-[#FFE298] tw-text-primary"
                        >
                            <p class="tw-text-xs">Table</p>
                            <h1 class="tw-text-xl tw-font-bold">
                                {{ $table_no }}
                            </h1>
                        </div>
                    </div>
                    <hr class="tw-border-dashed" />
                    <div class="tw-flex tw-justify-between tw-gap-3 tw-px-3">
                        <p class="tw-text-xs tw-text-[#D9D9D9]">Order No</p>
                        <p class="tw-text-xs">{{ $temporary_order_id }}</p>
                    </div>
                    <div
                        class="tw-flex tw-justify-between tw-gap-3 tw-px-3 tw-pb-3"
                    >
                        <p class="tw-text-xs tw-text-[#D9D9D9]">Order Date</p>
                        <p class="tw-text-xs">{{ $cartItems->first()->created_at->format('d F Y') }}</p>
                    </div>
                </div>
                <div
                    class="tw-flex tw-flex-col tw-gap-2 tw-rounded-[10px] tw-bg-primary tw-p-3 tw-text-white"
                >
                    <h1 class="tw-text-start tw-text-sm tw-font-bold">
                        Order Summary
                    </h1>
                    @foreach ($cartItems as $item)
                        @if ($item->quantity < 1)
                            <div></div>
                        @else
                            <div class="tw-flex tw-justify-between tw-gap-3">
                                <div class="tw-flex tw-items-start tw-gap-5">
                                    <p
                                        class="tw-text-xs tw-font-bold tw-text-[#FFE298]"
                                    >
                                        {{ $item->quantity }}x
                                    </p>
                                    <p
                                        class="tw-text-xs tw-font-semibold tw-text-white"
                                    >
                                        {{ $item->product->product_nama }}
                                    </p>
                                </div>
                                <p class="tw-text-xs tw-font-bold">
                                    Rp{{ number_format($item->product->product_harga * $item->quantity, 0, ",", ".") }}
                                </p>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <a
            class="d-flex gap-2 tw-w-[100%] tw-items-center tw-justify-center tw-rounded-[20px] tw-bg-primary tw-px-3 tw-py-3 tw-text-sm tw-font-semibold tw-tracking-wider tw-text-white"
            href="{{ route("frontend.personal_information", ["table_no" => $table_no, "customer_id" => $customer_id]) }}"
        >
            Continue
        </a>
        @endif
    </div>
@endsection
