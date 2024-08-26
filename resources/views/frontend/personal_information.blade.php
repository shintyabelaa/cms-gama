@extends("frontend.layout")

@section("content")
    <div
        class="tw-flex tw-h-[100vh] tw-flex-col tw-justify-between tw-px-5 tw-pb-5 tw-pt-9 tw-text-center"
    >
        <div class="tw-flex tw-flex-grow tw-flex-col tw-gap-[30px]">
            <div class="tw-flex tw-items-center tw-justify-between tw-gap-8">
                <a
                    href="{{ route("frontend.homepage.index", ["table_no" => $table_no, "customer_id" => $customer->customer_id]) }}"
                >
                    <iconify-icon icon="ep:arrow-left-bold"></iconify-icon>
                </a>
                <h1 class="tw-text-xl tw-font-semibold">Your Bill</h1>
                <a
                    class="gap-2 tw-flex tw-items-center tw-justify-center tw-rounded-xl tw-border-2 tw-border-primary tw-px-4 tw-py-2 tw-font-bold tw-text-primary hover:tw-text-primary"
                    href="{{ route("frontend.homepage.index", ["table_no" => $table_no, "customer_id" => $customer->customer_id]) }}"
                >
                    <iconify-icon
                        class="tw-text-lg"
                        icon="basil:plus-outline"
                    ></iconify-icon>
                    Add More
                </a>
            </div>
            <div class="tw-flex tw-flex-col tw-gap-2">
                <div class="tw-flex tw-flex-col tw-justify-start tw-text-start">
                    <p class="tw-items-start tw-font-bold tw-text-[#5E5454]">
                        Personal Information
                    </p>
                    <p class="tw-text-xs tw-leading-5 tw-text-[#5E5454]">
                        The data is used for order process. Make sure you enter
                        a valid data.
                    </p>
                </div>
                <div>
                    <form
                        id="personalInformationForm"
                        class="tw-flex tw-flex-col tw-gap-5"
                        method="POST"
                        action="{{ route("frontend.customer.update", ["table_no" => $table_no]) }}" 
                    >
                        @csrf
                        <div>
                            <label
                                for="name"
                                class="form-label !tw-mb-0 tw-flex tw-gap-2"
                            >
                                <input
                                    type="text"
                                    class="form-control tw-relative tw-rounded-lg tw-border-primary tw-ps-8 tw-text-primary placeholder:tw-text-[#D9D9D9]"
                                    id="name"
                                    name="name"
                                    placeholder="Full Name"
                                    required
                                />
                                <iconify-icon
                                    icon="mdi:account-outline"
                                    class="tw-absolute tw-start-7 tw-text-lg tw-text-primary"
                                ></iconify-icon>
                            </label>
                        </div>
                        {{-- <div>
                            <label
                                for="email"
                                class="form-label !tw-mb-0 tw-flex tw-gap-2"
                            >
                                <input
                                    type="text"
                                    class="form-control tw-relative tw-rounded-lg tw-border-primary tw-ps-8 tw-text-primary placeholder:tw-text-[#D9D9D9]"
                                    id="email"
                                    name="email"
                                    placeholder="Email"
                                    required
                                />
                                <iconify-icon icon="mi:email" class="tw-text-lg tw-text-primary tw-absolute tw-start-7"></iconify-icon>
                            </label>
                        </div> --}}
                        <div>
                            <label
                                for="phone"
                                class="form-label !tw-mb-0 tw-flex tw-gap-2"
                            >
                                <input
                                    type="text"
                                    class="form-control tw-relative tw-rounded-lg tw-border-primary tw-ps-8 tw-text-primary placeholder:tw-text-[#D9D9D9]"
                                    id="phone"
                                    name="phone"
                                    value="{{ $customer->no_telepon }}"
                                />
                                <iconify-icon
                                    icon="solar:phone-outline"
                                    class="tw-absolute tw-start-7 tw-text-lg tw-text-primary"
                                ></iconify-icon>
                            </label>
                        </div>
                        <div>
                            <label
                                for="table"
                                class="form-label !tw-mb-0 tw-flex tw-gap-2"
                            >
                                <input
                                    type="text"
                                    class="form-control tw-relative tw-rounded-lg tw-border-primary tw-ps-8 tw-text-primary placeholder:tw-text-[#D9D9D9]"
                                    id="table"
                                    name="table"
                                    value={{ $table_no }}
                                    readonly
                                />
                                <iconify-icon
                                    icon="material-symbols:table-bar-outline-rounded"
                                    class="tw-absolute tw-start-7 tw-text-lg tw-text-primary"
                                ></iconify-icon>
                            </label>
                        </div>
                        <button
                            class="d-flex gap-2 tw-w-[100%] tw-items-center tw-justify-center tw-rounded-[20px] tw-bg-primary tw-px-3 tw-py-3 tw-text-sm tw-font-semibold tw-tracking-wider tw-text-white"
                            type="submit"
                        >
                            Continue
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
