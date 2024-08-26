@extends("frontend.layout")

@section("content")
    <div
        class="tw-relative tw-flex tw-h-full tw-items-center tw-justify-center tw-bg-welcome tw-bg-cover tw-bg-no-repeat tw-pb-5 tw-pt-9"
    >
        {{-- <div class="tw-absolute tw-inset-0 tw-z-10 tw-bg-gradient-to-r tw-from-[#563516] tw-via-[#CA8B5] tw-to-secondary tw-opacity-50"></div> --}}
        <div class="tw-flex tw-flex-col tw-gap-[52px] tw-text-center">
            <h1 class="tw-mb-32 tw-text-[26px] tw-font-bold tw-text-white">
                WELCOME TO
            </h1>
            <div
                class="tw-relative tw-flex tw-flex-col tw-gap-2 tw-rounded-md tw-bg-primary tw-p-4 tw-pt-20 tw-text-white tw-shadow-md"
            >
                <div
                    class="tw-absolute -tw-top-32 tw-left-0 tw-z-10 tw-flex tw-w-full tw-items-center tw-justify-center"
                >
                    <img
                        class=""
                        width="231"
                        src="{{ asset("assets/images/gama-logo.svg") }}"
                        alt=""
                    />
                </div>
                <div class="tw-flex tw-items-center tw-gap-3">
                    <iconify-icon
                        class="tw-text-lg"
                        icon="bytesize:location"
                    ></iconify-icon>
                    <p class="tw-text-[10px]">
                        Jl. Sungai No.97, Pangkalan Jati Ba...
                    </p>
                    <a
                        class="tw-text-[10px] tw-text-[#FFE298] hover:tw-underline tw-cursor-pointer"
                        href="https://maps.app.goo.gl/ZBy87pw42Um21dBJ8"
                    >
                        see map
                    </a>
                </div>
                <div class="tw-flex tw-items-center tw-gap-3">
                    <iconify-icon
                        class="tw-text-lg"
                        icon="ion:time-outline"
                    ></iconify-icon>
                    <p class="tw-text-[10px]">
                        currently
                        <span class="tw-font-bold">Open</span>
                        - 22.00 WIB
                    </p>
                </div>
                <a
                    class="px-4 d-flex gap-2 tw-mt-12 tw-w-[100%] tw-items-center tw-justify-center tw-rounded-xl tw-bg-[#FFE298] tw-py-2 tw-font-bold tw-text-primary hover:tw-text-primary"
                    href="{{ route("frontend.review", ["table_no" => $table_no]) }}"
                >
                    <i class="mdi mdi-whatsapp icon-md"></i>
                    Customer Review
                </a>
            </div>
            <div class="tw-flex tw-justify-center tw-gap-4">
                <div
                    id="dine-in-card"
                    class="selectable-card tw-flex tw-h-28 tw-w-28 tw-flex-col tw-items-center tw-justify-center tw-rounded-xl tw-bg-white tw-p-2 hover:tw-border-2 hover:tw-border-primary hover:tw-shadow-[2px_4px_4px_0px_#9A583F] tw-cursor-pointer"
                >
                    <img
                        class="tw-flex tw-items-center tw-justify-center"
                        width="53"
                        height="53"
                        src="{{ asset("assets/frontend/images/dinner.svg") }}"
                        alt=""
                    />
                    <p class="tw-font-bold tw-text-primary">Dine in</p>
                </div>
                <div
                    id="take-away-card"
                    class="selectable-card tw-flex tw-h-28 tw-w-28 tw-flex-col tw-items-center tw-justify-center tw-rounded-xl tw-bg-white tw-p-2 hover:tw-border-2 hover:tw-border-primary hover:tw-shadow-[2px_4px_4px_0px_#9A583F] tw-cursor-pointer"
                >
                    <img
                        class="tw-flex tw-items-center tw-justify-center"
                        width="53"
                        height="53"
                        src="{{ asset("assets/frontend/images/food-delivery.svg") }}"
                        alt=""
                    />
                    <p class="tw-font-bold tw-text-primary">Take Away</p>
                </div>
            </div>
            <form
                action="{{ route("frontend.store.phone", ["table_no" => $table_no]) }}"
                method="POST"
                class="tw-mx-auto tw-flex tw-max-w-sm tw-flex-col tw-gap-10"
            >
                <input
                    type="hidden"
                    name="order_type"
                    id="orderTypeInput"
                    value=""
                />
                @csrf
                <div class="tw-flex tw-items-center">
                    <div
                        class="tw-hover:bg-gray-200 dark:tw-hover:bg-gray-600 dark:tw-focus:ring-gray-700 tw-z-10 tw-inline-flex tw-flex-shrink-0 tw-items-center tw-rounded-s-lg tw-border-r-2 tw-border-gray-300 tw-bg-primary tw-px-4 tw-py-2.5 tw-text-center tw-text-base tw-font-medium tw-text-white focus:tw-outline-none focus:tw-ring-4 focus:tw-ring-gray-100 dark:tw-border-gray-600 dark:tw-bg-gray-700 dark:tw-text-white"
                    >
                        +62
                    </div>
                    <div class="tw-relative tw-w-full">
                        <input
                            type="text"
                            name="no_telepon"
                            id="phone-input"
                            class="tw-z-20 tw-block tw-w-full tw-rounded-e-lg tw-border-s-0 tw-bg-primary tw-p-2.5 tw-text-base tw-text-slate-100 focus:tw-border-blue-500 focus:tw-ring-blue-500 dark:tw-border-gray-600 dark:tw-border-s-gray-700 dark:tw-bg-gray-700 dark:tw-text-white dark:tw-placeholder-gray-400 dark:focus:tw-border-blue-500"
                            placeholder="No Handphone"
                            required
                        />
                    </div>
                </div>
                <div class="tw-flex tw-flex-col tw-gap-2">
                    {{-- <div class="tw-flex tw-items-start">
                        <div class="tw-flex tw-h-5 tw-items-center">
                            <input
                                id="remember"
                                type="checkbox"
                                value=""
                                class="tw-h-4 tw-w-4 tw-rounded tw-border tw-border-primary tw-bg-none tw-accent-primary"
                            />
                        </div>
                        <label
                            for="remember"
                            class="tw-ms-2 tw-text-xs tw-text-white dark:tw-text-gray-300"
                        >
                            Let us inform you our next recommended menu
                        </label>
                    </div> --}}
                    <button
                        type="submit"
                        class="px-4 d-flex gap-2 tw-w-[100%] tw-items-center tw-justify-center tw-rounded-xl tw-bg-primary tw-py-2 tw-font-bold tw-tracking-wider tw-text-white"
                    >
                        SUBMIT
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section("scripts")
    <script src="https://code.iconify.design/2/2.1.2/iconify.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cards = document.querySelectorAll('.selectable-card');
            const orderTypeInput = document.getElementById('orderTypeInput');

            cards.forEach((card) => {
                card.addEventListener('click', function () {
                    // Remove shadow and border from all cards
                    cards.forEach((c) => {
                        c.style.border = '';
                        c.style.boxShadow = '';
                    });

                    // Add shadow and border to the selected card
                    this.style.border = '2px solid #9A583F';
                    this.style.boxShadow = '2px 4px 4px 0px #9A583F';

                    // Store the selected order type in the hidden input
                    orderTypeInput.value =
                        this.querySelector('p').textContent.trim();
                });
            });
        });
    </script>
@endsection
