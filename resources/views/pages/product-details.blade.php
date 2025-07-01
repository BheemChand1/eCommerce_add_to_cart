<x-app-layout>
    <section class="wsus__product mt_145 pb_100">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-xl-5 wow fadeInLeft">
                    <div class="wsus__product_details_slider_area">
                        <div class="row slider-forFive">
                            <div class="col-xl-12">
                                <div class="wsus__product_details_slide_show_img">
                                    <img src="{{ asset('uploads/' . $product->image)}}" alt="product"
                                        class="img-fluid w-100">
                                </div>
                            </div>

                            @foreach ($product->images as $image)
                                <div class="col-xl-12">
                                    <div class="wsus__product_details_slide_show_img">
                                        <img src="{{ asset('uploads/' . $image->path)}}" alt="product"
                                            class="img-fluid w-100">
                                    </div>
                                </div>
                            @endforeach



                        </div>
                        <div class="wsus__product_details_slider">
                            <div class="row slider-navFive">
                                <div class="col-xl-2">
                                    <div class="wsus__product_details_slider_img">
                                        <img src="{{ asset('uploads/' . $product->image)}}" alt="product"
                                            class="img-fluid w-100">
                                    </div>
                                </div>
                                @foreach ($product->images as $image)
                                    <div class="col-xl-2">
                                        <div class="wsus__product_details_slider_img">
                                            <img src="{{ asset('uploads/' . $image->path)}}" alt="product"
                                                class="img-fluid w-100">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-xl-7 wow fadeInRight">
                    <div class="wsus__product_summary">
                        <h2>Black Sneakers</h2>

                        <h6>${{$product->price}}</h6>
                        <p>{{$product->short_description}}
                        </p>

                        <h6 class="mt_30">Color</h6>
                        <select class="select_2" name="state">
                            <option value="AL">Select Color</option>
                            @foreach ($product->colors as $Color)
                                <option value="{{$Color->name}}">{{$Color->name}}</option>
                            @endforeach
                        </select>


                        <div class="wsus__product_add_cart">
                            <div class="wsus__product_quantity">
                                <button class="minus" type="submit"><i class="far fa-minus"></i></button>
                                <input type="text" placeholder="01">
                                <button class="plus" type="submit"><i class="far fa-plus"></i></button>
                            </div>
                            <div class="wsus__buy_cart_button">
                                {{-- <a href="#" class="cart"><img src="{{asset('assets/images/cart_icon_black.svg')}}"
                                        alt="cart" class="img-fluid w-100"></a> --}}
                                <a href="" class="common_btn add-to-cart" data-id="{{ $product->id }}">Add To Cart</a>
                            </div>
                        </div>
                        <ul class="wishlist d-flex flex-wrap">
                            <li><a href="#"><span><i class="fal fa-heart"></i></span>ADD TO WISHLIST</a></li>
                            <li><a href="#"><span><i class="fal fa-share-alt"></i></span>SHARE</a></li>
                        </ul>
                        <ul class="details">
                            <li>SKU:<span>{{$product->sku}}</span></li>

                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="wsus__product_details_menu_contant">
                        <div class="wsus__product_description wow fadeInUp">
                            {!! $product->description !!}



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <x-slot name="scripts">
        <script>
            $(document).ready(function () {
                $('.add-to-cart').on("click", function (e) {
                    e.preventDefault();
                    let id = $(this).data('id');

                    $.ajax({
                        method: 'POST',
                        url: "{{ url('/add-to-cart') }}/" + id, // Adjust if your route expects something else
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        beforeSend: function () {
                            console.log("Adding to cart...");
                        },
                        success: function (data) {
                            alert("Item added to cart!");
                            console.log(data);
                        },
                        error: function (xhr, status, error) {
                            alert("Something went wrong!");
                            console.error(xhr.responseText);
                        }
                    });
                });
            });
        </script>
    </x-slot>


</x-app-layout>