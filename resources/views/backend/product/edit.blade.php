@extends('backend.layouts.layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Create Product Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('backend.product.index')}}">Product</a></li>
                    <li class="breadcrumb-item active">Create</li>
                </ol>
            </nav>
        </div>
        @if(session('message'))
            <div class="alert alert-warning alert-dismissible fade show col-lg-6"
                 style="display: flex; justify-content: space-between; align-items: center" role="alert">
                <strong>{{session('message')}}</strong>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show col-lg-6">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="section">
            <div class="row g-3">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Edit A Product</h5>
                            <form class="row g-3" method="POST" action="{{route('backend.product.update', ['id' => $product['id']])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-6">
                                    <label for="name" class="form-label">Product Name
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="text" name="name" value="{{$product['name']}}" class="form-control" id="name" autofocus required>
                                </div>
                                <div class="col-md-6">
                                    <label for="quantity" class="form-label">Quantity
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="quantity" value="{{$product['quantity']}}" class="form-control" id="quantity" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price
                                        <span class="text-danger">*</span>
                                    </label>
                                    <input type="number" name="price" value="{{$product['price']}}" class="form-control" id="price" placeholder="9.99" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="brand" class="form-label">Brand
                                        <span class="text-danger">*</span>
                                    </label>
                                    <select required id="brand" name="brand_id" class="form-select">
                                        <option selected value="{{$product->brand['id']}}">{{$product->brand['name']}}</option>
                                        @foreach($brands as $brand)
                                            <option value="{{$brand['id']}}">{{$brand['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="product_categories_create" class="form-label">Category
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex">
                                        <select name="categories[]" id="product_categories_edit" multiple>
                                            @php
                                                $productCategoryIds = $product->categories->pluck('id')->toArray();
                                            @endphp
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ in_array($category['id'], $productCategoryIds) ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="product_sizes_create" class="form-label">Size(optional)</label>
                                    <div class="d-flex">
                                        <select name="sizes[]" id="product_sizes_edit" multiple>
                                            @php
                                                $productSizeIds = $product->sizes->pluck('id')->toArray();
                                            @endphp
                                            @foreach($sizes as $size)
                                                <option value="{{$size['id']}}" {{ in_array($size['id'], $productSizeIds) ? 'selected' : '' }}>
                                                    {{$size['name']}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" id="imageContainer">
                                    <label for="images" class="form-label">Images(Up to 4)
                                        <span class="text-danger">*</span>
                                    </label>
                                    @php
                                        $productImageCount = count($product->images);
                                    @endphp
                                    @if($productImageCount != 0)
                                        <div class="input-group mb-3">
                                            @foreach($product->images as $product_image)
                                                <div class="mb-3">
{{--                                                    <input type="hidden" name="images[]">--}}
                                                    <a href="{{route('backend.product.showImage', ['image' => $product_image['image']])}}">
                                                        <img src="{{asset('/'.\App\Const\ImageFolderPath::PRODUCT.'/'.$product_image['image'])}}" alt="product_image" width="100" height="100" class="rounded object-fit-cover border">
                                                    </a>
                                                    <a href="{{route('backend.productImage.delete', ['id' => $product_image['id']])}}" class="btn btn-outline-danger rounded" style="margin-right: 10px">-</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    @if($productImageCount < 4)
                                        <div class="input-group input-group1 mb-3">
                                            <input type="file" class="form-control rounded marginr form-control1" id="images" name="images[]" multiple>
                                            <button class="btn btn-outline-secondary rounded incrementBtn1" id="incrementBtn1" type="button">+</button>
                                            <button class="btn btn-outline-secondary rounded decrementBtn1" style="display: none" type="button">-</button>
                                        </div>
                                    @endif
                                </div>

                                <div class="col-md-12" id="colorContainer">
                                    <label for="productColor" class="form-label">Product Color
                                        <span class="text-danger">*</span>
                                    </label>
                                    @if(count($product->colors) != 0)
                                        <div class="input-group mb-3">
                                            @foreach($product->colors as $product_color)
                                                <div class="m-1 border rounded p-2 input-group22 marginl">
                                                    <p>{{$product_color['name']}}</p>
                                                    <a href="{{route('backend.product.showImage', ['image' => $product_color['image']])}}">
                                                        <img src="{{asset('/'.\App\Const\ImageFolderPath::PRODUCT_COLOR.'/'.$product_color['image'])}}" alt="product_image" width="35" height="35" class="rounded object-fit-cover">
                                                    </a>
                                                    <a href="{{route('backend.productColor.delete', ['id' => $product_color['id']])}}" class="btn btn-outline-danger rounded" style="margin-right: 10px">-</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif

                                    <div class="input-group input-group2 mb-3">
                                        <input type="file" class="form-control rounded marginr form-control2" id="productColor" name="product_color_images[]" multiple>
                                        <input type="text" class="form-control rounded marginr form-control21" id="productColor1" name="product_color_names[]" multiple placeholder="color name">
                                        <button class="btn btn-outline-secondary rounded incrementBtn2" id="incrementBtn2" type="button">+</button>
                                        <button class="btn btn-outline-secondary rounded decrementBtn2" type="button" style="display: none;">-</button>
                                    </div>
                                </div>

                                <div class="col-md-12" id="featuresContainer">
                                    <label for="productColor" class="form-label">Feature(optional)</label>
                                    @if(count($product->features) != 0)
                                        <div class="mb-3">
                                            @foreach($product->features as $product_feature)
                                                <div class="d-flex mb-1">
                                                    <div class="form-control">{{$product_feature['key']}}</div>
                                                    <div class="form-control marginl">{{$product_feature['value']}}</div>
                                                    <a href="{{route('backend.productFeature.delete', ['id' => $product_feature['id']])}}" class="btn btn-outline-danger rounded marginl" style="margin-right: 10px">-</a>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="input-group input-group3 mb-3">
                                        <input type="text" class="form-control rounded marginr form-control3" id="productColor" name="product_feature_keys[]" multiple placeholder="new key">
                                        <input type="text" class="form-control rounded marginr form-control31" id="productColor1" name="product_feature_values[]" multiple placeholder="new value">
                                        <button class="btn btn-outline-secondary rounded incrementBtn3" id="incrementBtn3" type="button">+</button>
                                        <button class="btn btn-outline-secondary rounded decrementBtn3" type="button" style="display: none;">-</button>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <label for="productColor" class="form-label">Description
                                        <span class="text-danger">*</span>
                                    </label>
                                    <textarea id="product_description_edit" name="description">
                                        {{$product['description']}}
                                    </textarea>
                                </div>

                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Reset</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

@endsection

@section('script')
    <script>
        new MultiSelectTag('product_categories_edit', {
            rounded: true,    // default true
            placeholder: 'Search',  // default Search...
            tagColor: {
                textColor: '#000000',
                borderColor: '#888888',
                bgColor: '#f5f5f5',
            },
            onChange: function (values) {
                console.log(values)
            }
        });
        new MultiSelectTag('product_sizes_edit', {
            rounded: true,    // default true
            placeholder: 'Search',  // default Search...
            tagColor: {
                textColor: '#000000',
                borderColor: '#888888',
                bgColor: '#f5f5f5',
            },
            onChange: function (values) {
                console.log(values)
            }
        });
        image_inc()
        color_inc()
        feature_inc()

        function image_inc() {
            const container = document.getElementById('imageContainer');
            const maxInputs = 4;

            container.addEventListener('click', function (event) {
                const target = event.target;
                if (target.classList.contains('incrementBtn1')) {
                    handleIncrement(target);
                } else if (target.classList.contains('decrementBtn1')) {
                    handleDecrement(target);
                }
            });

            function handleIncrement(button) {
                const inputGroup = button.closest('.input-group1');
                const clonedInputGroup = inputGroup.cloneNode(true);
                const currentInputs = container.querySelectorAll('.input-group1').length + {{$productImageCount}};

                clonedInputGroup.querySelector('.form-control1').value = '';

                clonedInputGroup.querySelector('.incrementBtn1').style.display = 'none';
                clonedInputGroup.querySelector('.decrementBtn1').style.display = 'inline-block';

                if (currentInputs < maxInputs) {
                    container.appendChild(clonedInputGroup);
                }

                if (currentInputs + 1 === maxInputs) {
                    button.disabled = true;
                }
            }

            function handleDecrement(button) {
                const inputGroup = button.closest('.input-group1');
                inputGroup.remove();
                document.getElementById('incrementBtn1').disabled = false;
            }
        }

        function color_inc() {
            const container = document.getElementById('colorContainer');
            const maxInputs = 7;

            container.addEventListener('click', function (event) {
                const target = event.target;
                if (target.classList.contains('incrementBtn2')) {
                    handleIncrement(target);
                } else if (target.classList.contains('decrementBtn2')) {
                    handleDecrement(target);
                }
            });

            function handleIncrement(button) {
                const inputGroup = button.closest('.input-group2');
                const clonedInputGroup = inputGroup.cloneNode(true);
                const currentInputs = container.querySelectorAll('.input-group2').length;

                clonedInputGroup.querySelector('.form-control2').value = '';
                clonedInputGroup.querySelector('.form-control21').value = '';

                clonedInputGroup.querySelector('.incrementBtn2').style.display = 'none';
                clonedInputGroup.querySelector('.decrementBtn2').style.display = 'inline-block';

                if (currentInputs < maxInputs) {
                    container.appendChild(clonedInputGroup);
                }

                if (currentInputs + 1 === maxInputs) {
                    button.disabled = true;
                }
            }

            function handleDecrement(button) {
                const inputGroup = button.closest('.input-group2');
                inputGroup.remove();
                document.getElementById('incrementBtn2').disabled = false;
            }
        }

        function feature_inc() {
            const container = document.getElementById('featuresContainer');

            container.addEventListener('click', function (event) {
                const target = event.target;
                if (target.classList.contains('incrementBtn3')) {
                    handleIncrement(target);
                } else if (target.classList.contains('decrementBtn3')) {
                    handleDecrement(target);
                }
            });

            function handleIncrement(button) {
                const inputGroup = button.closest('.input-group3');
                const clonedInputGroup = inputGroup.cloneNode(true);

                clonedInputGroup.querySelector('.form-control3').value = '';
                clonedInputGroup.querySelector('.form-control31').value = '';

                clonedInputGroup.querySelector('.incrementBtn3').style.display = 'none';
                clonedInputGroup.querySelector('.decrementBtn3').style.display = 'inline-block';
                container.appendChild(clonedInputGroup);
            }

            function handleDecrement(button) {
                const inputGroup = button.closest('.input-group3');
                inputGroup.remove();
                document.getElementById('incrementBtn3').disabled = false;
            }
        }

        //editor

        $(document).ready(function() {
            $('#product_description_edit').summernote();
        });
    </script>

@endsection
