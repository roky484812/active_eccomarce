<div class="modal-body px-4 py-5 c-scrollbar-light">
    <form data-toggle="validator" action="{{ route('payment.checkout') }}" method="POST">
        @csrf
        <input type="hidden" name="total_shipping_cost"/>
        <input type="hidden" name="shipping_type_9" value="home_delivery"/>
        <input type="hidden" name="additional_info" value=""/>
        <input type="hidden" name="payment_option" value="cash_on_delivery"/>
        <input type="hidden" name="country_code" value="88"/>


        {{-- head text --}}
        <div style="font-size: 19px;" class="text-center font-weight-bold">
            <div>
                ক্যাশ অন ডেলিভারিতে
            </div>
            <div>
                অর্ডার করতে আপনার তথ্য দিন
            </div>
        </div>

        {{-- customer details --}}
        <div>
            <div class="mt-2 h6">
                <label for="name" style="font-size: .95em;" class="font-weight-bold">
                    আপনার নাম <span class="text-danger">*</span>
                </label>
                <div class="input-group mb-2">
                    <div class="input-group-text"><i  style="font-size:20px" class="lar la-user"></i></div>
                    <input type="text" class="form-control" id="name" name="name" placeholder="আপনার নাম" required>
                </div>
            </div>

            <div class="mt-2 h6">
                <label for="phone" style="font-size: .95em;" class="font-weight-bold">
                    ফোন নাম্বার <span class="text-danger">*</span>
                </label>
                <div class="input-group mb-2">
                    <div class="input-group-text"><i class="las la-phone" style="font-size:20px"></i></div>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="ফোন নাম্বার" required>
                </div>
            </div>

            <div class="mt-2 h6">
                <label for="address" style="font-size: .95em;" class="font-weight-bold">
                    এড্রেস <span class="text-danger">*</span>
                </label>
                <div class="input-group mb-2">
                    <div class="input-group-text">
                        <i style="font-size:20px"  class="las la-map-marker"></i>
                    </div>
                    <input type="text" class="form-control" id="address" name="address" placeholder="এড্রেস " required>
                </div>
            </div>
        </div>

        {{-- delivary informations --}}
        <div class="my-4 font-weight-bold"  style="font-size: 19px;" >
            <label for="">
                শিপিং মেথড
            </label>
            <div class="list-group" style="font-size:16px;">
                <label for="dhaka" class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="radio" id="dhaka" value="70" name="delivery" required>
                            <label for="dhaka" class="m-0 ml-2">ঢাকা সিটির ভিতরে</label>
                        </div>
                        <div>Tk 70.00</div>
                    </div>
                </label>
                <label for="kusthia" class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="radio" id="kusthia" value="70" name="delivery" required>
                            <label for="kusthia" class="m-0 ml-2">কুষ্টিয়া সিটির ভিতরে</label>
                        </div>
                        <div>Tk 70.00</div>
                    </div>
                </label>
                <label for="out_of_dhaka" class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="radio" id="out_of_dhaka" value="130" name="delivery" required>
                            <label for="out_of_dhaka" class="m-0 ml-2">ঢাকা ও কুষ্টিয়া সিটির বাহিরে</label>
                        </div>
                        <div>Tk 130.00</div>
                    </div>
                </label>
            </div>
        </div>
        @php
            $total_price = 0;
        @endphp
        {{-- product details --}}
        @foreach ($carts as $cart)
            @php
                $total_price += cart_product_price($cart, $cart->product, false) * $cart->quantity;
            @endphp
            <input type="hidden" value="{{ cart_product_price($cart, $cart->product, false) * $cart->quantity }}" class="cart_product_price">
            <ul class="list-group list-group-flush border-top border-bottom">
                <li class="list-group-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div >
                            <span class="position-relative d-inline-block">
                                <img class="lazyload size-50px img-fit rounded-0"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($cart->product->thumbnail_img) }}"
                                    alt="Product Image"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                                >
                                <span class="badge badge-secondary position-absolute" style="top:0px; right:0%;">
                                    {{$cart->quantity}}
                                </span>
                            </span>
                            <span class="font-weight-bold ml-2">{{  Str::limit(($cart->product->getTranslation('name')), 35, '...')  }}</span>
                        </div>
                        <div class="font-weight-bold">{{ single_price(cart_product_price($cart, $cart->product, false) * $cart->quantity) }}</div>
                    </div>
                </li>
            </ul>
        @endforeach


        <ul class="list-group d-flex justify-content-between my-3" style="font-size:16px;">
            <li class="list-group-item bg-soft-secondary">
                <div class="d-flex justify-content-between">
                    <span>সাব টোটাল </span>
                    <span>{{ single_price($total_price) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>ডেলিভারি চার্জ </span>
                    <span id="delivary">৳0</span>
                </div>
            </li>
            <li class="list-group-item bg-soft-secondary" style="border-top: 1px solid #d1d1d1;">
                <div class="d-flex justify-content-between font-weight-bold">
                    <span> সর্বমোট </span>
                    <span id="total">৳{{ number_format($total_price, 2) }}</span>
                </div>
            </li>
        </ul>
        <!-- total amount -->
        <button class="btn btn-warning btn-lg btn-block">আপনার অর্ডার কনফার্ম করতে ক্লিক করুন</button>
        <h5 class="text-center text-success mt-3">উপরের বাটনে ক্লিক করলে আপনার অর্ডারটি সাথে সাথে কনফার্ম হয়ে যাবে !</h5>
    </form>
</div>
<script>
    $(document).ready(function() {
        let cart_count = {{ count($carts) }};
        let total = {{ $total_price }};
        $('input[type=radio][name=delivery]').change(function() {
            let total_dalivary_charge = this.value * cart_count;
            $('#delivary').text('৳'+ (formatNumber(total_dalivary_charge)));
            $('#total').text('৳'+ (formatNumber(total_dalivary_charge + total)));
            $('input[name=total_shipping_cost]').val(total_dalivary_charge);
        });
        function formatNumber(num) {
            // Create a NumberFormat object with the desired format
            const formatter = new Intl.NumberFormat('en-US', {
                style: 'decimal',
                minimumFractionDigits: 2,
                maximumFractionDigits: 2
            });

            // Use the format method to get the formatted string
            return formatter.format(num);
        }
    });
</script>
