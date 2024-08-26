@extends("frontend.layout")

@section("content")
    <div
        class="tw-flex tw-flex-col tw-justify-between tw-px-5 tw-pb-5 tw-pt-9 tw-text-center"
    >
        <div class="tw-flex tw-flex-grow tw-flex-col tw-gap-[30px]">
            <div class="tw-grid tw-grid-flow-row-dense tw-grid-cols-3">
                <h1
                    class="tw-col-span-2 tw-flex tw-items-center tw-justify-end tw-text-xl tw-font-semibold"
                >
                    Detail Transaction
                </h1>
                <!-- Button to trigger modal -->
                <button
                    type="button"
                    class="btn"
                    data-bs-toggle="modal"
                    data-bs-target="#feedbackModal"
                >
                    <iconify-icon
                        class="tw-text-5xl tw-text-primary"
                        icon="ic:round-cancel"
                    ></iconify-icon>
                </button>

                <!-- Modal -->
                <div
                    class="modal fade"
                    id="feedbackModal"
                    tabindex="-1"
                    aria-labelledby="feedbackModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content p-4 tw-relative">
                            <div class="modal-header border-0">
                                <h5
                                    class="modal-title mx-auto tw-tracking-[1px] tw-text-primary"
                                    id="feedbackModalLabel"
                                >
                                    Your feedback & review important to us!
                                </h5>
                                <button
                                    type="button"
                                    class="btn-close tw-absolute tw-right-4 tw-top-4 tw-text-primary"
                                    data-bs-dismiss="modal"
                                    aria-label="Close"
                                ></button>
                            </div>
                            <div class="modal-body">
                                <form
                                    id="feedbackForm"
                                    method="POST"
                                    action="{{ route("frontend.reviews.store", ["table_no" => $table_no]) }}"
                                >
                                    @csrf
                                    <input type="hidden" name="customer_id" value="{{ $customer->customer_id }}">

                                    <div class="mb-4">
                                        <label
                                            for="name"
                                            class="form-label tw-flex tw-gap-2"
                                        >
                                            <iconify-icon
                                                icon="mdi:account-outline"
                                                class="tw-text-lg tw-text-primary"
                                            ></iconify-icon>
                                            <input
                                                type="text"
                                                class="form-control tw-border-primary tw-text-primary"
                                                id="name"
                                                name="name"
                                                placeholder="Full Name"
                                                value="{{ $customer->customer_nama }}"
                                                readonly
                                            />
                                        </label>
                                    </div>
                                    <div
                                        class="mb-4 text-center tw-flex tw-flex-col tw-items-center"
                                    >
                                        <p class="mb-2 tw-text-primary">
                                            How was your experience?
                                        </p>
                                        <div class="star-rating">
                                            <input
                                                type="hidden"
                                                name="ulasan_rating"
                                                id="rating-input"
                                                value="0"
                                            />
                                            <img
                                                class="star me-1"
                                                src="{{ asset("assets/images/star-unselected-1.svg") }}"
                                                alt="star 1"
                                            />
                                            <img
                                                class="star me-1"
                                                src="{{ asset("assets/images/star-unselected-2.svg") }}"
                                                alt="star 2"
                                            />
                                            <img
                                                class="star me-1"
                                                src="{{ asset("assets/images/star-unselected-3.svg") }}"
                                                alt="star 3"
                                            />
                                            <img
                                                class="star me-1"
                                                src="{{ asset("assets/images/star-unselected-4.svg") }}"
                                                alt="star 4"
                                            />
                                            <img
                                                class="star me-1"
                                                src="{{ asset("assets/images/star-unselected-5.svg") }}"
                                                alt="star 5"
                                            />
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <textarea
                                            class="form-control tw-rounded-xl tw-border-primary"
                                            name="ulasan_deskripsi"
                                            rows="4"
                                            placeholder="Tuliskan pengalaman anda selama mengunjungi kafe gama"
                                            required
                                        ></textarea>
                                    </div>
                                    <div class="text-center">
                                        <button
                                            type="submit"
                                            class="btn btn-primary tw-w-full"
                                        >
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="tw-mt-7 tw-flex tw-w-full tw-items-center tw-justify-center"
            >
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
                                class="tw-dark:bg-gray-700 tw-flex tw-h-0.5 tw-w-full tw-bg-gray-200"
                            ></div>
                        </div>
                    </li>
                    <li class="tw-relative tw-mb-6 tw-w-full">
                        <div
                            class="tw-relative tw-flex tw-items-center tw-justify-center"
                        >
                            <div
                                class="tw-dark:bg-gray-700 tw-sm:ring-8 tw-dark:ring-gray-900 tw-absolute tw-z-10 tw-flex tw-h-6 tw-w-6 tw-shrink-0 tw-items-center tw-justify-center tw-rounded-full tw-bg-primary tw-ring-0 tw-ring-white"
                            >
                                <svg
                                    class="tw-dark:text-white tw-h-2.5 tw-w-2.5 tw-text-blue-100"
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
                @switch($order->status)
                    @case("process")
                        <div
                            class="tw-flex tw-flex-col tw-gap-2 tw-rounded-lg tw-border-2 tw-border-primary tw-px-3 tw-py-2 tw-text-primary"
                        >
                            <p class="tw-text-start tw-font-semibold">
                                We process your order
                            </p>
                            <div
                                class="tw-flex tw-items-center tw-justify-between"
                            >
                                <p class="tw-font-medium">Estimation</p>
                                <div
                                    class="tw-flex tw-items-center tw-justify-center tw-gap-[10px] tw-align-middle"
                                >
                                    <iconify-icon
                                        class="tw-text-lg"
                                        icon="ion:time-outline"
                                    ></iconify-icon>

                                    <p class="tw-font-semibold">15 - 20 mins</p>
                                </div>
                            </div>
                        </div>

                        @break
                    @case("unpaid")
                        <div
                            class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-gap-2 tw-rounded-lg tw-border-2 tw-border-none tw-bg-green-200 tw-px-3 tw-py-2 tw-text-slate-800"
                        >
                            <p class="tw-font-semibold">Your Order Has Done!</p>
                            <p class="tw-font-medium">Pay At Cashier</p>
                        </div>

                        @break
                    @case("paid")
                        <div
                            class="tw-flex tw-flex-col tw-items-center tw-justify-center tw-gap-2 tw-rounded-lg tw-border-2 tw-border-none tw-bg-primary tw-px-3 tw-py-2 tw-text-white"
                        >
                            <p class="tw-font-semibold">Thank You!</p>
                            <p class="tw-font-medium">Order Successfully</p>
                        </div>

                        @break
                    @default
                @endswitch

                <div
                    class="tw-flex tw-flex-col tw-gap-4 tw-rounded-[10px] tw-bg-primary tw-p-3 tw-text-white"
                >
                    <div class="tw-flex tw-justify-between tw-gap-3">
                        <div
                            class="tw-flex tw-flex-col tw-items-start tw-gap-1"
                        >
                            <h2 class="tw-text-lg tw-font-bold tw-text-white">
                                Rp{{ number_format($order->total, 0, ",", ".") }}
                            </h2>
                            <p class="tw-text-xs tw-text-[#D9D9D9]">
                                Gama. Coffee House
                            </p>
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
                    <div
                        class="tw-flex tw-flex-col tw-items-start tw-justify-center tw-gap-1 tw-rounded-lg tw-bg-[#FFE298] tw-px-3 tw-py-1"
                    >
                        <p class="tw-text-xs tw-text-[#5E5454]">
                            Customer Name
                        </p>
                        <h1 class="tw-text-xs tw-text-primary">
                            {{ $customer->customer_nama }}
                        </h1>
                    </div>
                    <hr class="tw-border-dashed" />
                    <div class="tw-flex tw-flex-col tw-gap-2">
                        <div class="tw-flex tw-justify-between">
                            <p class="tw-text-xs tw-text-[#D9D9D9]">Order No</p>
                            <p class="tw-text-xs">{{ $order->order_id }}</p>
                        </div>
                        <div class="tw-flex tw-justify-between tw-pb-3">
                            <p class="tw-text-xs tw-text-[#D9D9D9]">
                                Order Date
                            </p>
                            <p class="tw-text-xs">
                                {{ $order->created_at->format("d M Y") }}
                            </p>
                        </div>
                    </div>
                </div>
                <div
                    class="tw-flex tw-flex-col tw-gap-2 tw-rounded-[10px] tw-bg-primary tw-p-3 tw-text-white"
                >
                    <div class="tw-flex tw-justify-between tw-gap-3">
                        <p class="tw-text-xs tw-text-[#D9D9D9]">Subtotal</p>
                        <p class="tw-text-xs">
                            Rp{{ number_format($order->subtotal, 0, ",", ".") }}
                        </p>
                    </div>
                    <div class="tw-flex tw-justify-between tw-gap-3">
                        <p class="tw-text-xs tw-text-[#D9D9D9]">Tax</p>
                        <p class="tw-text-xs">
                            Rp{{ number_format($order->tax, 0, ",", ".") }}
                        </p>
                    </div>
                    <hr class="tw-border-dashed" />
                    <div class="tw-flex tw-justify-between tw-gap-3">
                        <p class="tw-text-xs tw-text-[#D9D9D9]">Total Order</p>
                        <p class="tw-text-xs">
                            Rp{{ number_format($order->total, 0, ",", ".") }}
                        </p>
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
    </div>
@endsection

@section("scripts")
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const stars = document.querySelectorAll('.star-rating .star');
            const ratingInput = document.getElementById('rating-input');

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    ratingInput.value = index + 1; // Set the rating value based on the star clicked
                    stars.forEach((s, i) => {
                        if (i <= index) {
                            s.src = `/assets/images/star-selected-${i + 1}.svg`;
                        } else {
                            s.src = `/assets/images/star-unselected-${i + 1}.svg`;
                        }
                    });
                });
            });
        });
    </script>
@endsection
