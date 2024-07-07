<div class="modal-body px-4 py-5 c-scrollbar-light">
    <form action="{{route('checkout')}}">
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
                    <input type="text" class="form-control" id="name" name="name" placeholder="আপনার নাম">
                </div>
            </div>

            <div class="mt-2 h6">
                <label for="phone" style="font-size: .95em;" class="font-weight-bold">
                    ফোন নাম্বার <span class="text-danger">*</span>
                </label>
                <div class="input-group mb-2">
                    <div class="input-group-text"><i class="las la-phone" style="font-size:20px"></i></div>
                    <input type="text" class="form-control" id="phone" name="phone" placeholder="ফোন নাম্বার">
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
                    <input type="text" class="form-control" id="address" name="address" placeholder="এড্রেস ">
                </div>
            </div>
        </div>

        {{-- delivary informations --}}
        <div class="mt-4 font-weight-bold"  style="font-size: 19px;" >
            <label for="">
                শিপিং মেথড
            </label>
            <div class="list-group" style="font-size:16px;">
                <label for="dhaka" class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="mr-2"><input type="radio" id="dhaka" name="delivery"></span>
                            <label for="dhaka" class="m-0">ঢাকা সিটির ভিতরে</label>
                        </div>
                        <div>Tk 70.00</div>
                    </div>
                </label>
                <label for="out_of_dhaka" class="list-group-item">
                    <div class="d-flex justify-content-between">
                        <div>
                            <span class="mr-2"><input type="radio" id="out_of_dhaka" name="delivery"></span>
                            <label for="out_of_dhaka" class="m-0">ঢাকা সিটির বাহিরে</label>
                        </div>
                        <div>Tk 130.00</div>
                    </div>
                </label>
            </div>
        </div>

        {{-- product details --}}
        <ul class="list-group list-group-flush border-top border-bottom mt-4">
            <li class="list-group-item">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="position-relative">
                        <img class="lazyload size-50px img-fit rounded-0"
                            src="{{ static_asset('assets/img/placeholder.jpg') }}"
                            data-src="{{ uploaded_asset($product->thumbnail_img) }}"
                            alt="Product Image"
                            onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';"
                        >
                        <span class="badge badge-secondary position-absolute" style="top:0px; right:0%;">
                            {{$cart->quantity}}
                        </span>
                    </div>
                    <div class="font-weight-bold">{{  $product->getTranslation('name')  }}</div>
                    <div class="font-weight-bold">{{ single_price(cart_product_price($cart, $product, false) * $cart->quantity) }}</div>
                </div>
            </li>
        </ul>

        <!-- total amount -->
        <ul class="list-group d-flex justify-content-between my-3" style="font-size:16px;">
            <li class="list-group-item bg-soft-secondary">
                <div class="d-flex justify-content-between">
                    <span>সাব টোটাল </span>
                    <span>{{ single_price(cart_product_price($cart, $product, false) * $cart->quantity) }}</span>
                </div>
                <div class="d-flex justify-content-between">
                    <span>ডেলিভারি চার্জ </span>
                    <span id="delivary">0</span>
                </div>
            </li>
            <li class="list-group-item bg-soft-secondary" style="border-top: 1px solid #d1d1d1;">
                <div class="d-flex justify-content-between font-weight-bold">
                    <span> সর্বমোট </span>
                    <span id="total">{{ single_price(cart_product_price($cart, $product, false) * $cart->quantity) }}</span>
                </div>
            </li>
        </ul>
        <button class="btn btn-warning btn-lg btn-block">আপনার অর্ডার কনফার্ম করতে ক্লিক করুন</button>
        <h5 class="text-center text-success mt-3">উপরের বাটনে ক্লিক করলে আপনার অর্ডারটি সাথে সাথে কনফার্ম হয়ে যাবে !</h5>
    </form>

    testing cart data
    <pre>
        {{$carts}}
    </pre>
</div>
