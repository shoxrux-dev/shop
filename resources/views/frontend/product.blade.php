@extends('/frontend.layouts.layout')
@section('content')
    <main class="main">
        <nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
            <div class="container d-flex align-items-center">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Products</li>
                </ol>
            </div>
        </nav>
        <div class="page-content">
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

                <div class="product-details-top">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-gallery product-gallery-vertical">
                                <div class="row">
                                    <figure class="product-main-image">
                                        <img id="product-zoom" src="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[0]['image']) }}" data-zoom-image="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[0]['image']) }}" alt="product image">

                                        <a href="#" id="btn-product-gallery" class="btn-product-gallery">
                                            <i class="icon-arrows"></i>
                                        </a>
                                    </figure>

                                    <div id="product-zoom-gallery" class="product-image-gallery">
                                        @foreach($product->images as $index => $product_image)
                                            <a class="product-gallery-item {{ $index === 0 ? 'active' : '' }}" href="#" data-image="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product_image['image']) }}" data-zoom-image="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product_image['image']) }}" style="max-width: 106.8px; max-height: 106.8px;">
                                                <img src="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product_image['image']) }}" alt="product side" style="object-fit: cover">
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="product-details">
                                <h1 class="product-title">{{$product['name']}}</h1>

                                <div class="ratings-container">
                                    <div class="ratings">
                                        <div class="ratings-val" style="width: 80%;"></div>
                                    </div>
                                    <a class="ratings-text" href="#product-review-link" id="review-link">( 2 Reviews )</a>
                                </div>

                                <div class="product-price">
                                    ${{$product['price']}}
                                </div>

                                <form action="{{route('frontend-add-to-cart')}}" method="post">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product['id']}}">
                                    <div class="details-filter-row details-row-size">
                                        <label>Color:</label>
                                        <div class="product-nav product-nav-thumbs parent">
                                            <div class="row">
                                                @foreach($product->colors as $index => $product_color)
                                                        <div class=''>
                                                            <input type="radio" name="product_color_id" id="{{$product_color['id']}}" class="d-none imgbgchk" value="{{$product_color['id']}}" required @if($index === 0) checked @endif>
                                                            <label for="{{$product_color['id']}}">
                                                                <img src="{{ asset('/'.App\Const\ImageFolderPath::PRODUCT_COLOR.'/'.$product_color['image']) }}" alt="Image 1">
                                                            </label>
                                                        </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <div class="details-filter-row details-row-size">
                                        <label for="size">Size:</label>
                                        <div class="select-custom">
                                        @if($errors->any())
                                                <select name="product_size_id" id="size" class="form-control" style="border: 1px solid red">
                                                    <option value="#" selected="selected">Select a size</option>
                                                    @foreach($product->sizes as $product_size)
                                                        <option value="{{$product_size['id']}}">{{$product_size['name']}}</option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <select name="product_size_id" id="size" class="form-control" required>
                                                    <option value="#" selected="selected">Select a size</option>
                                                    @foreach($product->sizes as $product_size)
                                                        <option value="{{$product_size['id']}}">{{$product_size['name']}}</option>
                                                    @endforeach
                                                </select>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="details-filter-row details-row-size">
                                        <label for="qty">Qty:</label>
                                        <div class="product-details-quantity">
                                            <input name="product_quantity" type="number" id="qty" class="form-control" value="1" min="1" max="10" step="1" data-decimals="0" required>
                                        </div>
                                    </div>

                                    <div class="product-details-action">
                                        <button type="submit" class="btn-product btn-cart btn-add-to-cart-product"><span>add to cart</span></button>
                                        <div class="details-action-wrapper">
                                            <a href="#" class="btn-product btn-wishlist" title="Wishlist"><span>Add to Wishlist</span></a>
                                        </div>
                                    </div>
                                </form>

                                <div class="product-details-footer">
                                    <div class="product-cat">
                                        <span>Category:</span>
                                        @foreach($product->categories as $product_category)
                                            <a href="{{route('frontend.category.products', ['slug' => $product_category['slug']])}}">{{$product_category['name']}}</a>,
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="product-details-tab">
                    <ul class="nav nav-pills justify-content-center" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews (2)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                            <div class="product-desc-content">
                                <h3>Product Information</h3>
                                <p>{!!$product['description']!!}</p>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                            <div class="product-desc-content">
                                <h3>Information</h3>
                                @foreach($product->features as $product_feature)
                                    <div class="d-flex mb-0.5">
                                        <div class="col-md-4 d-flex p-0">
                                            <div class="col-start-auto" style="padding-right: 10px">{{$product_feature['key']}}</div>
                                            <div class="col" style="border-bottom: 2px dashed #7c7c7c; margin-bottom: 7px"></div>
                                        </div>
                                        <div class="col-md-4">{{$product_feature['value']}}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                            <div class="reviews">
                                <h3>Reviews (2)</h3>
                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">Samanta J.</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 80%;"></div>
                                                </div>
                                            </div>
                                            <span class="review-date">6 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Good, perfect size</h4>

                                            <div class="review-content">
                                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus cum dolores assumenda asperiores facilis porro reprehenderit animi culpa atque blanditiis commodi perspiciatis doloremque, possimus, explicabo, autem fugit beatae quae voluptas!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (2)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="review">
                                    <div class="row no-gutters">
                                        <div class="col-auto">
                                            <h4><a href="#">John Doe</a></h4>
                                            <div class="ratings-container">
                                                <div class="ratings">
                                                    <div class="ratings-val" style="width: 100%;"></div>
                                                </div>
                                            </div>
                                            <span class="review-date">5 days ago</span>
                                        </div>
                                        <div class="col">
                                            <h4>Very good</h4>

                                            <div class="review-content">
                                                <p>Sed, molestias, tempore? Ex dolor esse iure hic veniam laborum blanditiis laudantium iste amet. Cum non voluptate eos enim, ab cumque nam, modi, quas iure illum repellendus, blanditiis perspiciatis beatae!</p>
                                            </div>

                                            <div class="review-action">
                                                <a href="#"><i class="icon-thumbs-up"></i>Helpful (0)</a>
                                                <a href="#"><i class="icon-thumbs-down"></i>Unhelpful (0)</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <h2 class="title text-center mb-4">You May Also Like</h2>

                <div class="owl-carousel owl-simple carousel-equal-height carousel-with-shadow" data-toggle="owl"
                     data-owl-options='{
                            "nav": false,
                            "dots": true,
                            "margin": 20,
                            "loop": false,
                            "responsive": {
                                "0": {
                                    "items":1
                                },
                                "480": {
                                    "items":2
                                },
                                "768": {
                                    "items":3
                                },
                                "992": {
                                    "items":4
                                },
                                "1200": {
                                    "items":4,
                                    "nav": true,
                                    "dots": false
                                }
                            }
                        }'>

                    @foreach($otherProducts as $product)
                        <div class="col-6 col-md-4 col-lg-4 col-xl-3" style="max-width: 297px; max-height: 466px;">
                            <div class="product">
                                <figure>
                                    <a href="{{route('frontend.product', ['slug' => $product['slug']])}}">
                                        @if(isset($product->images[0]))
                                            <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[0]['image'])}}" alt="Product image" class="product-image rounded-lg object-fit-cover" style="background-position: center; max-width: 277px; max-height: 277px; min-width: 277px; min-height: 277px; object-fit: cover">
                                        @endif
                                        @if(isset($product->images[1]))
                                            <img src="{{asset('/'.App\Const\ImageFolderPath::PRODUCT.'/'.$product->images[1]['image'])}}" alt="Product image" class="product-image-hover object-fit-cover" style="max-width: 277px; max-height: 277px; min-width: 277px; min-height: 277px; object-fit: cover">
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
                                            <a href="#" class="btn-product-icon" style="border: 1px solid; border-radius: 50%; width: 3rem; height: 3rem">
                                                <i class="icon-cart-plus"></i>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

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
