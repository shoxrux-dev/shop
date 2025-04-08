@extends('frontend.layouts.layout')
@section('content')

    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav mb-2">
            <div class="container">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                    <li class="breadcrumb-item active">{{ $category_name }}</li>
                </ol>
            </div>
        </nav>

        <div class="page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9">
                        @if(session('success'))
                            <div class="m-5 d-flex justify-content-center">
                                <div class="alert alert-success alert-dismissible fade show rounded col-md-9" role="alert">
                                    {{session('success')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if(session('alreadyAdded'))
                            <div class="m-5 d-flex justify-content-center">
                                <div class="alert alert-warning alert-dismissible fade show rounded col-md-9" role="alert">
                                    {{session('alreadyAdded')}}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            </div>
                        @endif
                        @if (count($products) != 0)
                            <div class="products mb-3">
                                <div class="row justify-content-center">
                                        @foreach($products as $product)
                                            <div class="col-6 col-md-4 col-lg-4 col-xl-3">
                                                <div class="product">
                                                    <figure>
                                                        <a href="{{route('frontend.product', ['slug' => $product['slug']])}}">
                                                            <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[0]['image'])}}" alt="Product image" class="product-image" style="max-width: 203px; max-height: 203px; object-fit: cover; background-position: center">
                                                            @if(isset($product->images[1]))
                                                                <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[1]['image'])}}" alt="Product image" class="product-image-hover">
                                                            @endif
                                                        </a>

                                                        <div class="product-action-vertical">
                                                            <a href="#" class="btn-product-icon btn-wishlist" style="background-color: white"></a>
{{--                                                            <a href="{{asset('frontend/popup/quickView.html')}}" class="btn-product-icon btn-quickview" title="Quick view"></a>--}}
                                                        </div>

                                                        {{--                                                    <div class="" style="border: none">--}}
                                                        {{--                                                        <a href="#"--}}
                                                        {{--                                                           class="btn-product btn-cart"><span>add to cart</span></a>--}}
                                                        {{--                                                    </div>--}}
                                                    </figure>

                                                    <div class="product-body">
                                                        {{--                                                    <div class="product-cat">--}}
                                                        {{--                                                        <a href="#">Dresses</a>--}}
                                                        {{--                                                    </div>--}}
                                                        <h3 class="product-title">
                                                            <a href="{{route('frontend.product', ['slug' => $product['slug']])}}">{{$product['name']}}</a>
                                                        </h3>
                                                        <div class="product-price" style="text-align: left">
                                                            ${{$product['price']}}
                                                        </div>
                                                        {{--                                                    <div class="ratings-container">--}}
                                                        {{--                                                        <div class="ratings">--}}
                                                        {{--                                                            <div class="ratings-val" style="width: 0%;"></div>--}}
                                                        {{--                                                        </div>--}}
                                                        {{--                                                        <span class="ratings-text">( 0 Reviews )</span>--}}
                                                        {{--                                                    </div>--}}

                                                        <div class="product-nav product-nav-thumbs d-flex justify-content-between">
                                                            <div class="d-flex">
                                                                @foreach($product->colors as $index => $product_colors)
                                                                    @if ($index < 4)
                                                                        <a>
                                                                            <img src="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT_COLOR.'/'.$product_colors['image']) }}" alt="product desc" style="max-width: 35px; max-height: 35px; object-fit: cover; background-position: center">
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
                            <nav aria-label="Page navigation">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item {{ $products->previousPageUrl() ? '' : 'disabled' }}">
                                        <a class="page-link page-link-prev" href="{{ $products->previousPageUrl() }}"
                                           aria-label="Previous" tabindex="-1"
                                           aria-disabled="{{ $products->previousPageUrl() ? 'false' : 'true' }}">
                                            <span aria-hidden="true"><i class="icon-long-arrow-left"></i></span> Prev
                                        </a>
                                    </li>

                                    @for ($i = 1; $i <= $products->lastPage(); $i++)
                                        <li class="page-item {{ $i == $products->currentPage() ? 'active' : '' }}"
                                            aria-current="{{ $i == $products->currentPage() ? 'page' : '' }}">
                                            <a class="page-link" href="{{ $products->url($i) }}">{{ $i }}</a>
                                        </li>
                                    @endfor

                                    <li class="page-item-total">of {{ $products->lastPage() }}</li>

                                    <li class="page-item {{ $products->nextPageUrl() ? '' : 'disabled' }}">
                                        <a class="page-link page-link-next" href="{{ $products->nextPageUrl() }}"
                                           aria-label="Next">
                                            Next <span aria-hidden="true"><i class="icon-long-arrow-right"></i></span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        @else
                            <p>No products available in this category.</p>
                        @endif
                    </div>
                    <aside class="col-lg-3 order-lg-first">
                        <div class="sidebar sidebar-shop">
                            <div class="widget widget-clean">
                                <label>Filters:</label>
                                <a href="#" class="sidebar-filter-clear">Clean All</a>
                            </div>
                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                                        Category
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-1">
                                    <div class="widget-body">
                                        <div class="filter-items filter-items-count">
                                            @foreach($child_categories as $child_category)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="cat-1">
                                                        <label class="custom-control-label" for="cat-1">{{$child_category['name']}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                                        Size
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-2">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach($sizes as $size)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="size'.{{$size['id']}}.'">
                                                        <label class="custom-control-label" for="size'.{{$size['id']}}.'">{{$size['name']}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="widget widget-collapsible">
                                <h3 class="widget-title">
                                    <a data-toggle="collapse" href="#widget-4" role="button" aria-expanded="true" aria-controls="widget-4">
                                        Brand
                                    </a>
                                </h3>

                                <div class="collapse show" id="widget-4">
                                    <div class="widget-body">
                                        <div class="filter-items">
                                            @foreach($brands as $brand)
                                                <div class="filter-item">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input" id="brand.'{{$brand['id']}}.'">
                                                        <label class="custom-control-label" for="brand.'{{$brand['id']}}.'">{{$brand['name']}}</label>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </main>
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
