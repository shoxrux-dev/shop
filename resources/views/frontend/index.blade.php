@extends('frontend.layouts.layout')
@section('content')
    <main class="main">
        <div class="container">
            @if(session('success'))
                <div class="m-5 d-flex justify-content-center">
                    <div class="alert alert-success alert-dismissible fade show rounded col-md-6" role="alert">
                        {{session('success')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
            @if(session('alreadyAdded'))
                <div class="m-5 d-flex justify-content-center">
                    <div class="alert alert-warning alert-dismissible fade show rounded col-md-6" role="alert">
                        {{session('alreadyAdded')}}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show col-lg-8" style="display: flex; justify-content: space-between; align-items: center">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
        </div>
        <div class="intro-slider-container mb-5">

            <div class="intro-slider owl-carousel owl-theme owl-nav-inside owl-light" data-toggle="owl"
                 data-owl-options='{
                        "dots": true,
                        "nav": false,
                        "responsive": {
                            "1200": {
                                "nav": true,
                                "dots": false
                            }
                        }
                    }'>

                <div class="intro-slide" style="background-image: url(frontend/assets/images/demos/demo-4/slider/slide-1.png);">
                    <div class="container intro-content">
                        <div class="row justify-content-end">
                            <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                <h3 class="intro-subtitle text-third">Deals and Promotions</h3>
                                <h1 class="intro-title">Beats by</h1>
                                <h1 class="intro-title">Dre Studio 3</h1>

                                <div class="intro-price">
                                    <sup class="intro-old-price">$349,95</sup>
                                    <span class="text-third">
                                            $279<sup>.99</sup>
                                        </span>
                                </div>

                                <a href="category.html" class="btn btn-primary btn-round">
                                    <span>Shop More</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="intro-slide" style="background-image: url(frontend/assets/images/demos/demo-4/slider/slide-2.png);">
                    <div class="container intro-content">
                        <div class="row justify-content-end">
                            <div class="col-auto col-sm-7 col-md-6 col-lg-5">
                                <h3 class="intro-subtitle text-primary">New Arrival</h3>
                                <h1 class="intro-title">Apple iPad Pro <br>12.9 Inch, 64GB </h1>

                                <div class="intro-price">
                                    <sup>Today:</sup>
                                    <span class="text-primary">
                                            $999<sup>.99</sup>
                                        </span>
                                </div>

                                <a href="category.html" class="btn btn-primary btn-round">
                                    <span>Shop More</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <span class="slider-loader"></span>
        </div>

{{--        <div class="container">--}}
{{--            <h2 class="title text-center mb-4">Explore Popular Categories</h2>--}}

{{--            <div class="cat-blocks-container">--}}
{{--                <div class="row">--}}
{{--                    @foreach($popularCategory as $category)--}}
{{--                        <div class="col-6 col-sm-4 col-lg-2">--}}
{{--                            <a href="{{route('frontend.category.products', ['slug' => $category['slug']])}}" class="cat-block">--}}
{{--                                <figure>--}}
{{--                                        <span>--}}
{{--                                            <img src="{{asset('/'.App\Const\ImageFolderPath::CATEGORY.'/'.$category['image'])}}" alt="Category image">--}}
{{--                                        </span>--}}
{{--                                </figure>--}}

{{--                                <h3 class="cat-block-title">{{$category->name}}</h3>--}}
{{--                            </a>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}

        <div class="mb-4"></div>
        <div class="container for-you">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">New Products</h2>
                </div>
            </div>

            <div class="products">
                <div class="row justify-content-center">
                    @foreach($lastTenProducts as $product)
                        <div class="col-6 col-md-4 col-lg-4 col-xl-3" style="max-width: 297px; max-height: 466px;">
                            <div class="product">
                                <figure>
                                    <span class="product-label label-circle label-new">New</span>
                                        <a href="{{route('frontend.product', ['slug' => $product['slug']])}}">
                                            @if(isset($product->images[0]))
                                                <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[0]['image'])}}" alt="Product image" class="product-image rounded-lg object-fit-cover" style="background-position: center; max-width: 277px; max-height: 277px; object-fit: cover">
                                            @endif
                                            @if(isset($product->images[1]))
                                                 <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[1]['image'])}}" alt="Product image" class="product-image-hover object-fit-cover" style="max-width: 277px; max-height: 277px; object-fit: cover">
                                            @endif
                                        </a>
                                    <div class="modal fade" id="delete'.{{$product['id']}}.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="card-title"></h5>
                                                    <button type="button" class="btn close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body d-flex justify-content-between">
                                                        <h4><span style="font-weight: bold">{{$product['name']}}</span>
                                                            <br> Do you want to delete?</h4>
                                                        <div class="d-flex justify-content-center align-items-center">
                                                            <a href="{{route('backend.product.delete', ['id' => $product['id']])}}" class="btn btn-danger">
                                                                delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-action-vertical">
                                        <a href="#" class="btn-product-icon btn-wishlist" style="background-color: white"></a>
                                    </div>
                                </figure>

                                <div class="product-body">
                                    <h3 class="product-title">
                                        <a href="{{route('frontend.product', ['slug' => $product['slug']])}}">
                                            {{$product['name']}}
                                        </a>
                                    </h3>
                                    <div class="product-price" style="text-align: left">
                                        ${{$product['price']}}
                                    </div>
                                    <div class="product-nav product-nav-thumbs d-flex justify-content-between">
                                        <div class="d-flex">
                                            @foreach($product->images as $index => $product_image)
                                                @if ($index > 0)
                                                    <a>
                                                        <img src="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product_image['image']) }}" alt="product desc" style="max-width: 35px; max-height: 35px; object-fit: cover; background-position: center">
                                                    </a>
                                                @endif
                                            @endforeach
                                        </div>

                                        <div style="padding: 7px 0">
                                            <form action="{{route('frontend-add-to-cart')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{$product['id']}}">
                                                <input type="hidden" name="product_color_id" value="{{$product->colors[0]['id']}}">
                                                    <input type="hidden" name="product_quantity" value="1">
                                                <input type="hidden" name="product_size_id" value="{{$product->sizes[0]['id']}}">
                                                <button type="submit" class="btn-product-icon" style="border: 1px solid; border-radius: 50%; width: 3rem; height: 3rem">
                                                    <i class="icon-cart-plus"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>

        <div class="mb-6"></div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="frontend/assets/images/demos/demo-4/banners/banner-1.png" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle"><a href="#">Smart Offer</a></h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title"><a href="#">Save $150 <strong>on Samsung <br>Galaxy Note9</strong></a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="frontend/assets/images/demos/demo-4/banners/banner-2.jpg" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle"><a href="#">Time Deals</a></h4><!-- End .banner-subtitle -->
                            <h3 class="banner-title"><a href="#"><strong>Bose SoundSport</strong> <br>Time Deal -30%</a></h3><!-- End .banner-title -->
                            <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-6 col-lg-4">
                    <div class="banner banner-overlay banner-overlay-light">
                        <a href="#">
                            <img src="frontend/assets/images/demos/demo-4/banners/banner-3.png" alt="Banner">
                        </a>

                        <div class="banner-content">
                            <h4 class="banner-subtitle"><a href="#">Clearance</a></h4>
                            <h3 class="banner-title"><a href="#"><strong>GoPro - Fusion 360</strong> <br>Save $70</a></h3>
                            <a href="#" class="banner-link">Shop Now<i class="icon-long-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mb-3"></div>

        <div class="container">
            <div class="cta cta-border mb-5" style="background-image: url(frontend/assets/images/demos/demo-4/bg-1.jpg);">
                <img src="frontend/assets/images/demos/demo-4/camera.png" alt="camera" class="cta-img">
                <div class="row justify-content-center">
                    <div class="col-md-12">
                        <div class="cta-content">
                            <div class="cta-text text-right text-white">
                                <p>Shop Today’s Deals <br><strong>Awesome Made Easy. HERO7 Black</strong></p>
                            </div><!-- End .cta-text -->
                            <a href="#" class="btn btn-primary btn-round"><span>Shop Now - $429.99</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .cta-content -->
                    </div><!-- End .col-md-12 -->
                </div><!-- End .row -->
            </div><!-- End .cta -->
        </div><!-- End .container -->

        <div class="container">
            <div class="heading text-center mb-3">
                <h2 class="title">Deals & Outlet</h2><!-- End .title -->
                <p class="title-desc">Today’s deal and more</p><!-- End .title-desc -->
            </div><!-- End .heading -->

            <div class="row">
                <div class="col-lg-6 deal-col">
                    <div class="deal" style="background-image: url('frontend/assets/images/demos/demo-4/deal/bg-1.jpg');">
                        <div class="deal-top">
                            <h2>Deal of the Day.</h2>
                            <h4>Limited quantities. </h4>
                        </div><!-- End .deal-top -->

                        <div class="deal-content">
                            <h3 class="product-title"><a href="product.html">Home Smart Speaker with  Google Assistant</a></h3><!-- End .product-title -->

                            <div class="product-price">
                                <span class="new-price">$129.00</span>
                                <span class="old-price">Was $150.99</span>
                            </div><!-- End .product-price -->

                            <a href="product.html" class="btn btn-link"><span>Shop Now</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .deal-content -->

                        <div class="deal-bottom">
                            <div class="deal-countdown daily-deal-countdown" data-until="+10h"></div><!-- End .deal-countdown -->
                        </div><!-- End .deal-bottom -->
                    </div><!-- End .deal -->
                </div><!-- End .col-lg-6 -->

                <div class="col-lg-6 deal-col">
                    <div class="deal" style="background-image: url('frontend/frontend/assets/images/demos/demo-4/deal/bg-2.jpg');">
                        <div class="deal-top">
                            <h2>Your Exclusive Offers.</h2>
                            <h4>Sign in to see amazing deals.</h4>
                        </div><!-- End .deal-top -->

                        <div class="deal-content">
                            <h3 class="product-title"><a href="product.html">Certified Wireless Charging  Pad for iPhone / Android</a></h3><!-- End .product-title -->

                            <div class="product-price">
                                <span class="new-price">$29.99</span>
                            </div><!-- End .product-price -->

                            <a href="login.html" class="btn btn-link"><span>Sign In and Save money</span><i class="icon-long-arrow-right"></i></a>
                        </div><!-- End .deal-content -->

                        <div class="deal-bottom">
                            <div class="deal-countdown offer-countdown" data-until="+11d"></div><!-- End .deal-countdown -->
                        </div><!-- End .deal-bottom -->
                    </div><!-- End .deal -->
                </div><!-- End .col-lg-6 -->
            </div><!-- End .row -->

            <div class="more-container text-center mt-1 mb-5">
                <a href="#" class="btn btn-outline-dark-2 btn-round btn-more"><span>Shop more Outlet deals</span><i class="icon-long-arrow-right"></i></a>
            </div><!-- End .more-container -->
        </div><!-- End .container -->

        <div class="container">
            <hr class="mb-0">
            <div class="owl-carousel mt-5 mb-5 owl-simple" data-toggle="owl"
                 data-owl-options='{
                        "nav": false,
                        "dots": false,
                        "margin": 30,
                        "loop": false,
                        "responsive": {
                            "0": {
                                "items":2
                            },
                            "420": {
                                "items":3
                            },
                            "600": {
                                "items":4
                            },
                            "900": {
                                "items":5
                            },
                            "1024": {
                                "items":6
                            }
                        }
                    }'>
                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/1.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/2.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/3.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/4.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/5.png" alt="Brand Name">
                </a>

                <a href="#" class="brand">
                    <img src="frontend/assets/images/brands/6.png" alt="Brand Name">
                </a>
            </div><!-- End .owl-carousel -->
        </div><!-- End .container -->

        <div class="mb-5"></div><!-- End .mb-5 -->

        <div class="container for-you">
            <div class="heading heading-flex mb-3">
                <div class="heading-left">
                    <h2 class="title">Recommendation For You</h2><!-- End .title -->
                </div><!-- End .heading-left -->

                <div class="heading-right">
                    <a href="#" class="title-link">View All Recommendadion <i class="icon-long-arrow-right"></i></a>
                </div><!-- End .heading-right -->
            </div><!-- End .heading -->

            <div class="products">
                <div class="row justify-content-center">
                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-sale">Sale</span>
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-10.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Headphones</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Beats by Dr. Dre Wireless  Headphones</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="new-price">$279.99</span>
                                    <span class="old-price">Was $349.99</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 40%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #666666;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #6699cc;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #f3dbc1;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">Color name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-11.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Cameras & Camcorders</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">GoPro - HERO7 Black HD Waterproof Action</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    $349.99
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-new">New</span>
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-12.jpg" alt="Product image" class="product-image">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-12-2.jpg" alt="Product image" class="product-image-hover">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Smartwatches</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Apple - Apple Watch Series 3 with White Sport Band</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    $214.49
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 0%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 0 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #e2e2e2;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #f2bc9e;"><span class="sr-only">Color name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-13.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Laptops</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Lenovo - 330-15IKBR 15.6"</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    <span class="out-price">$339.99</span>
                                    <span class="out-text">Out Of Stock</span>
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 11 Reviews )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-14.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Digital Cameras</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Sony - Alpha a5100 Mirrorless Camera</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    $499.99
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 50%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 11 Reviews )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-15.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Laptops</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Home Mini - Smart Speaker  with Google Assistant</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    $49.00
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 24 Reviews )</span>
                                </div><!-- End .rating-container -->

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #ef837b;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #333333;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #e2e2e2;"><span class="sr-only">Color name</span></a>
                                </div><!-- End .product-nav -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <span class="product-label label-circle label-sale">Sale</span>
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-16.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Audio</a>
                                </div>
                                <h3 class="product-title"><a href="product.html">WONDERBOOM Portable Bluetooth Speaker</a></h3>
                                <div class="product-price">
                                    <span class="new-price">$99.99</span>
                                    <span class="old-price">Was $129.99</span>
                                </div>
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 40%;"></div>
                                    </div>
                                    <span class="ratings-text">( 4 Reviews )</span>
                                </div>

                                <div class="product-nav product-nav-dots">
                                    <a href="#" class="active" style="background: #666666;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #ff887f;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #6699cc;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #f3dbc1;"><span class="sr-only">Color name</span></a>
                                    <a href="#" style="background: #eaeaec;"><span class="sr-only">Color name</span></a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-6 col-md-4 col-lg-3">
                        <div class="product product-2">
                            <figure class="product-media">
                                <a href="product.html">
                                    <img src="frontend/assets/images/demos/demo-4/products/product-17.jpg" alt="Product image" class="product-image">
                                </a>

                                <div class="product-action-vertical">
                                    <a href="#" class="btn-product-icon btn-wishlist" title="Add to wishlist"></a>
                                </div><!-- End .product-action -->

                                <div class="product-action">
                                    <a href="#" class="btn-product btn-cart" title="Add to cart"><span>add to cart</span></a>
                                    <a href="popup/quickView.html" class="btn-product btn-quickview" title="Quick view"><span>quick view</span></a>
                                </div><!-- End .product-action -->
                            </figure><!-- End .product-media -->

                            <div class="product-body">
                                <div class="product-cat">
                                    <a href="#">Smart Home</a>
                                </div><!-- End .product-cat -->
                                <h3 class="product-title"><a href="product.html">Google - Home Hub with  Google Assistant</a></h3><!-- End .product-title -->
                                <div class="product-price">
                                    $149.00
                                </div><!-- End .product-price -->
                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 60%;"></div><!-- End .ratings-val -->
                                    </div><!-- End .ratings -->
                                    <span class="ratings-text">( 2 Reviews )</span>
                                </div><!-- End .rating-container -->
                            </div><!-- End .product-body -->
                        </div><!-- End .product -->
                    </div><!-- End .col-sm-6 col-md-4 col-lg-3 -->
                </div><!-- End .row -->
            </div><!-- End .products -->
        </div><!-- End .container -->

        <div class="mb-4"></div><!-- End .mb-4 -->

        <div class="container">
            <hr class="mb-0">
        </div><!-- End .container -->

        <div class="icon-boxes-container bg-transparent">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rocket"></i>
                                </span>
                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Shipping</h3><!-- End .icon-box-title -->
                                <p>Orders $50 or more</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-rotate-left"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Free Returns</h3><!-- End .icon-box-title -->
                                <p>Within 30 days</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-info-circle"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">Get 20% Off 1 Item</h3><!-- End .icon-box-title -->
                                <p>when you sign up</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->

                    <div class="col-sm-6 col-lg-3">
                        <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="icon-life-ring"></i>
                                </span>

                            <div class="icon-box-content">
                                <h3 class="icon-box-title">We Support</h3><!-- End .icon-box-title -->
                                <p>24/7 amazing services</p>
                            </div><!-- End .icon-box-content -->
                        </div><!-- End .icon-box -->
                    </div><!-- End .col-sm-6 col-lg-3 -->
                </div>
            </div>
        </div>
    </main>
        <div class="cta bg-image bg-dark pt-4 pb-5 mb-0" style="background-image: url(frontend/assets/images/demos/demo-4/bg-5.jpg);">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-sm-10 col-md-8 col-lg-6">
                        <div class="cta-heading text-center">
                            <h3 class="cta-title text-white">Get The Latest Deals</h3><!-- End .cta-title -->
                            <p class="cta-desc text-white">and receive <span class="font-weight-normal">$20 coupon</span> for first shopping</p><!-- End .cta-desc -->
                        </div>

                        <form action="#">
                            <div class="input-group input-group-round">
                                <input type="email" class="form-control form-control-white" placeholder="Enter your Email Address" aria-label="Email Adress" required>
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><span>Subscribe</span><i class="icon-long-arrow-right"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
@endsection

@section('script')
    <script>
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function(){
                $(this).remove();
            });
        }, 1500);
    </script>
@endsection
