@extends("frontend.layout")

@section("content")
    <div
        class="tw-flex tw-flex-col tw-justify-between tw-pb-24 tw-pt-9 tw-text-center"
    >
        <!-- Header and Search Form -->
        <div class="tw-flex tw-flex-grow tw-flex-col tw-gap-[22px]">
            <div
                class="tw-flex tw-items-center tw-justify-between tw-gap-8 tw-px-5"
            >
                <h1
                    class="tw-text-base tw-font-normal tw-text-primary"
                    style="font-family: 'sansation'"
                >
                    <span style="font-family: 'dyadis'">GAMA.</span>
                    COFFEE HOUSE
                </h1>
                <div class="tw-flex tw-gap-2">
                    <a
                        href="{{ route("frontend.cart", ['table_no' => $table_no, 'customer_id' => $customer_id]) }}"
                        class="tw-text-2xl tw-text-primary hover:tw-text-primary"
                    >
                        <iconify-icon  icon="mdi:cart-outline"></iconify-icon>
                    </a>
                </div>
            </div>
            <div class="">
                <img
                    class="tw-w-full"
                    width="390"
                    src="{{ asset("assets/frontend/images/banner-miruku.png") }}"
                    alt="banner-promo"
                />
            </div>
            <form
                class="form-inline tw-px-5"
                action="{{ route("frontend.homepage.index", ['table_no' => $table_no]) }}"
                method="GET"
            >
                <input
                    class="form-control mr-sm-2 tw-rounded-2xl"
                    type="search"
                    name="search"
                    placeholder="Search"
                    aria-label="Search"
                    value="{{ request()->query("search") }}"
                />
            </form>
            <div class="tw-flex tw-flex-col tw-gap-3">
                <div class="tw-flex tw-flex-col tw-gap-3">
                    <div class="tw-flex tw-items-center tw-gap-6 tw-border-y-2 tw-py-2">
                        <div class="btn-group tw-pl-5">
                            <button
                                type="button"
                                class="btn btn-primary dropdown-toggle tw-fixed tw-w-fit tw-rounded-xl tw-border-none tw-bg-[#D6D5D5] tw-p-[6px] tw-font-semibold tw-text-[#5E5454] hover:tw-bg-[#D6D5D5] hover:tw-text-[#5E5454] active:tw-bg-[#D6D5D5] active:tw-text-[#5E5454]"
                                data-bs-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                            >
                                Category
                            </button>
                            <div class="dropdown-menu tw-h-[15vh] tw-scrollbar-hide">
                                @foreach ($products as $category => $items)
                                    <a class="dropdown-item" href="#{{ Str::slug($category) }}">
                                        {{ $category }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="tw-flex tw-flex-nowrap tw-items-center tw-gap-4 tw-overflow-x-auto tw-text-xs tw-font-semibold tw-uppercase tw-scrollbar-hide">
                            @foreach ($products as $category => $items)
                                <a
                                    class="nav-link tw-rounded-[20px] tw-px-[10px] tw-py-3"
                                    href="#{{ Str::slug($category) }}"
                                    id="link-{{ Str::slug($category) }}"
                                >
                                    {{ $category }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @foreach ($products as $category => $items)
                        <h1
                            class="tw-border-b-2 tw-pb-3 tw-pl-5 tw-text-start tw-text-sm tw-font-bold tw-uppercase tw-text-primary"
                            id="{{ Str::slug($category) }}"
                        >
                            {{ $category }}
                        </h1>
                        @foreach ($items as $product)
                            <div class="tw-flex tw-gap-5 tw-border-b-2 tw-px-5 tw-pb-4 tw-pt-1">
                                <img
                                    class="tw-rounded-lg tw-max-h-[77px]"
                                    width="72"
                                    height="77"
                                    src="{{ Storage::url($product->product_gambar) }}"
                                    alt="{{ $product->product_nama }}"
                                />
                                <div class="tw-flex tw-w-full tw-flex-col tw-justify-between">
                                    <div class="tw-flex tw-flex-col tw-gap-1 tw-text-start">
                                        <h2 class="tw-text-sm tw-font-bold tw-text-primary">
                                            {{ $product->product_nama }}
                                        </h2>
                                        <p class="text-[#5E5454]">
                                            {{ $product->product_deskripsi }}
                                        </p>
                                    </div>
                                    <div class="tw-mt-2 tw-flex tw-items-end tw-justify-between">
                                        <h3 class="tw-text-sm tw-font-bold tw-text-primary">
                                            Rp{{ number_format($product->product_harga, 0, ",", ".") }}
                                        </h3>
                                        <div class="tw-flex tw-items-center tw-justify-end tw-gap-1">
                                            <a href="#" class="minus-icon tw-flex tw-text-end tw-text-2xl tw-text-primary hover:tw-text-primary" data-id="{{ $product->product_id }}"
                                                @if($cartItems->where('product_id', $product->product_id)->first())
                                                    style="display: block"
                                                @else
                                                    style="display: none"
                                                @endif
                                            >
                                                <iconify-icon icon="ph:minus-circle-fill"></iconify-icon>
                                            </a>
                                            <p class="quantity tw-text-sm tw-font-semibold tw-text-primary hover:tw-text-primary"
                                                id="quantity-{{ $product->product_id }}"
                                                data-id="{{ $product->product_id }}">
                                                {{ $cartItems->where('product_id', $product->product_id)->first()->quantity ?? 0 }}
                                            </p>
                                            <a href="#" class="plus-icon tw-flex tw-text-end tw-text-2xl tw-text-primary hover:tw-text-primary" data-id="{{ $product->product_id }}">
                                                <iconify-icon icon="ph:plus-circle-fill"></iconify-icon>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div>
        <div
            id="continueButtonContainer"
            class="tw-fixed tw-bottom-0 tw-w-full"
            style="display: none"
        >
            <a
                id="continueButton"
                class="d-flex gap-2 tw-mx-auto tw-mb-5 tw-w-[50%] tw-items-center tw-justify-center tw-rounded-[20px] tw-bg-primary tw-px-3 tw-py-3 tw-text-sm tw-font-semibold tw-tracking-wider tw-text-white"
                href="{{ route('frontend.cart', ['table_no' => $table_no, 'customer_id' => $customer_id]) }}"
            >
                <iconify-icon icon="uil:cart" class="tw-text-2xl"></iconify-icon>
                Cart
                <span id="cartCount" class="tw-bg-white tw-text-primary tw-rounded-full tw-w-4 tw-h-4 tw-text-center tw-flex tw-items-center tw-justify-center">0</span>
            </a>
        </div>
    </div>
@endsection

@section("scripts")
<script>
    document.addEventListener('DOMContentLoaded', function () {
        let totalItems = 0;

        function sendUpdateCartRequest(productId, quantity) {
            fetch('{{ route("frontend.add-to-cart", ['table_no' => $table_no]) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                }),
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Cart updated successfully');
                    console.log(data);

                }
            }).catch(error => {
                console.error('Error:', error);
            });
        }

        document.querySelectorAll('.plus-icon').forEach((button) => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const id = this.getAttribute('data-id');
                const quantityElement = document.getElementById('quantity-' + id);
                const minusIcon = document.querySelector(`.minus-icon[data-id="${id}"]`);

                let quantity = parseInt(quantityElement.textContent) || 0;
                quantity++;
                quantityElement.textContent = quantity;

                // Update the total items in the cart
                totalItems++;
                updateCartButton(totalItems);

                // Show minus icon and quantity
                minusIcon.style.display = 'flex';
                quantityElement.style.display = 'block';

                // Send AJAX request to update cart in backend
                sendUpdateCartRequest(id, 1);
            });
        });

        document.querySelectorAll('.minus-icon').forEach((button) => {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                const id = this.getAttribute('data-id');
                const quantityElement = document.getElementById('quantity-' + id);
                const minusIcon = this;

                let quantity = parseInt(quantityElement.textContent) || 0;
                if (quantity > 0) {
                    quantity--;
                    quantityElement.textContent = quantity;

                    // Update the total items in the cart
                    totalItems--;
                    updateCartButton(totalItems);

                    // Hide minus icon and quantity if quantity reaches 0
                    if (quantity === 0) {
                        minusIcon.style.display = 'none';
                        quantityElement.style.display = 'none';
                    }
                    // Send AJAX request to update cart in backend
                    sendUpdateCartRequest(id, -1);
                }
            });
        });

        function updateCartButton(totalItems) {
            const cartCountElement = document.getElementById('cartCount');
            const continueButtonContainer = document.getElementById('continueButtonContainer');
            const continueButton = document.getElementById('continueButton');

            cartCountElement.textContent = totalItems;

            if (totalItems > 0) {
                continueButtonContainer.style.display = 'block';
                continueButton.href = "{{ route('frontend.cart', ['table_no' => $table_no, 'customer_id' => $customer_id]) }}"; // Update the href to point to the cart page
            } else {
                continueButtonContainer.style.display = 'none';
            }
        }

        // Initial call to set the correct visibility for each item
        document.querySelectorAll('.quantity').forEach((element) => {
            const id = element.getAttribute('data-id');
            const minusIcon = document.querySelector(`.minus-icon[data-id="${id}"]`);
            let quantity = parseInt(element.textContent) || 0;

            if (quantity > 0) {
                minusIcon.style.display = 'flex';
                element.style.display = 'block';
                totalItems += quantity;
            } else {
                minusIcon.style.display = 'none';
                element.style.display = 'none';
            }
        });

        // Update cart button on initial load
        updateCartButton(totalItems);
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categoryLinks = document.querySelectorAll('.nav-link');
        const sections = document.querySelectorAll('h1[id]');

        // Scroll Event Listener to Change Active Category
        window.addEventListener('scroll', function () {
            let current = '';

            sections.forEach(section => {
                const sectionTop = section.offsetTop;
                const sectionHeight = section.clientHeight;

                if (window.pageYOffset >= sectionTop - 50 && window.pageYOffset < sectionTop + sectionHeight - 50) {
                    current = section.getAttribute('id');
                }
            });

            categoryLinks.forEach(link => {
                link.classList.remove('tw-bg-primary');
                link.classList.remove('tw-text-white');
                if (link.getAttribute('href').substring(1) === current) {
                    link.classList.add('tw-bg-primary');
                    link.classList.add('tw-text-white');
                }
            });
        });

        // Smooth scrolling to sections
        categoryLinks.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(link.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    });
</script>
@endsection
