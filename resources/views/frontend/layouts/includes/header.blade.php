<header class="header header-intro-clearance header-4">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:#"><i class="icon-phone"></i>Call: +998 99 755-81-42</a>
            </div>
            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">

                                    <a href="#">English</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">English</a></li>
                                            <li><a href="#">Russian</a></li>
                                            <li><a href="#">Uzbek</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>

                            <li>
                                @auth
                                    <div class="header-dropdown">

                                        <a href="#">{{Auth::user()->name}}</a>
                                        <div class="header-menu">
                                            <ul>
                                                <li><a href="#">Profile</a></li>
                                                <li>
                                                    <form method="POST" action="{{route('logout')}}">
                                                        @csrf
                                                        <button class="logout-btn" type="submit">Logout</button>
                                                    </form>
                                                </li>
                                                @if(Auth::user()->hasRole('admin'))
                                                    <li><a href="{{route('backend.index')}}">Dashboard</a></li>
                                                @endif
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{route('login')}}">Sign In</a> /
                                    <a href="{{route('register')}}">Sign Up</a>
                                @endauth
                            </li>

                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

{{--    <div class="header-middle">--}}
{{--        <div class="container">--}}
{{--            <div class="header-left">--}}
{{--                <button class="mobile-menu-toggler">--}}
{{--                    <span class="sr-only">Toggle mobile menu</span>--}}
{{--                    <i class="icon-bars"></i>--}}
{{--                </button>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}

    <div class="header-middle sticky-header">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                <a href="{{route('frontend.index')}}" class="logo">
                    <img src="{{asset('frontend/assets/images/demos/demo-4/logo.png')}}" alt="Site Logo" width="105"
                         height="25">
                </a>
                <div class="dropdown category-dropdown custom-category-menu-button" style="margin: 25px 16px">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static" title="Browse Categories">
                        Katalog
                    </a>

                    <div class="dropdown-menu">
                        <nav class="side-nav">
                            <ul class="menu-vertical sf-arrows">
                                @foreach($categories as $category)
                                    <li class="megamenu-container">
                                        <a class="sf-with-ul" href="{{route('frontend.category.products', ['slug' => $category['slug']])}}">{{$category['name']}}</a>
                                        <div class="megamenu">
                                            <div class="row no-gutters">
                                                <div class="col-md-12">
                                                    <div class="menu-col">
                                                        <div class="row">
                                                            @foreach($category->children as $category_children)
                                                                <div class="col-md-4">
                                                                    <a href="{{route('frontend.category.products', ['slug' => $category_children['slug']])}}" class="menu-title hover-blue">{{$category_children['name']}}</a>
                                                                    <ul>
                                                                        @foreach($category_children->children as $child_children)
                                                                            <li><a href="{{route('frontend.category.products', ['slug' => $child_children['slug']])}}">{{$child_children['name']}}</a></li>
                                                                        @endforeach
                                                                    </ul>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <label for="q" class="sr-only">Search</label>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." required>
                        </div>
                    </form>
                </div>
            </div>

            <div class="header-right">

                <div class="wishlist">
                    <a href="wishlist.html" title="Wishlist">
                        <div class="icon">
                            <i class="icon-heart-o"></i>
                            <span class="wishlist-count badge">3</span>
                        </div>
                        <p>Wishlist</p>
                    </a>
                </div>

                <div class="dropdown cart-dropdown">
                    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true"
                       aria-expanded="false" data-display="static">
                        <div class="icon">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{count($carts)}}</span>
                        </div>
                        <p>Cart</p>
                    </a>

                    @if(count($carts) != 0)
                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">
                                @foreach($carts as $cart)
                                    <div class="product">
                                        <div class="product-cart-details">
                                            <h4 class="product-title">
                                                <a href="{{route('frontend.product', ['slug' => $cart->product['slug']])}}">{{$cart->product['name']}}</a>
                                            </h4>

                                            <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{$cart['product_quantity']}}</span>
                                                    x {{$cart->product['price']}}
                                                </span>
                                        </div>

                                        <figure class="product-image-container">
                                            <a href="{{route('frontend.product', ['slug' => $cart->product['slug']])}}" class="product-image">
                                                <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$cart->product->images[0]['image'])}}"
                                                     alt="product">
                                            </a>
                                        </figure>
                                        <a href="{{route('frontend-delete-from-cart', ['cartId' => $cart['id']])}}" class="btn-remove" title="Remove Product"><i class="icon-close"></i></a>
                                    </div>
                                @endforeach
                            </div>

                            <div class="dropdown-cart-total">
                                <span>Total</span>
                                @php
                                    $total = $carts->sum(fn($cart) => $cart->product['price'] * $cart['product_quantity']);
                                @endphp
                                <span class="cart-total-price">${{$total}}</span>
                            </div>

                            <div class="dropdown-cart-action">
                                <a href="cart.html" class="btn btn-primary">View Cart</a>
                                <a href="checkout.html" class="btn btn-outline-primary-2">
                                    <span>Checkout</span>
                                    <i class="icon-long-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</header>
