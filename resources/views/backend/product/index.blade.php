@extends('backend.layouts.layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Product Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Product</li>
                </ol>
            </nav>
        </div>
        @if(session('message'))
            <div class="alert alert-warning alert-dismissible fade show col-lg-8" style="display: flex; justify-content: space-between; align-items: center" role="alert">
                <strong>{{session('message')}}</strong>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show col-lg-8">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between m-3">
                                <h5 class="card-title"></h5>
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="card-title">Create New Product</h5>
                                                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form class="row g-3" method="POST" action="{{route('backend.product.store')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-md-6">
                                                            <label for="inputName5" class="form-label">Name
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" name="name" class="form-control" id="inputName5">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="inputName5" class="form-label">Quantity
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="number" name="quantity" class="form-control" id="inputName5">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="inputName5" class="form-label">Price
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" name="price" class="form-control" id="inputName5">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brand_id" class="form-label">Brand
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <select id="brand_id" name="brand_id" class="form-select">
                                                                <option value="">Select</option>
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
                                                                <select name="categories[]" id="product_categories_create" multiple>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="product_sizes_create" class="form-label">Size(optional)</label>
                                                            <div class="d-flex">
                                                                <select name="sizes[]" id="product_sizes_create" multiple>
                                                                    @foreach($sizes as $size)
                                                                        <option value="{{$size['id']}}">{{$size['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6" id="imageContainer">
                                                            <label for="images" class="form-label">Images(Up to 4)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group input-group1 mb-3">
                                                                <input type="file" class="form-control rounded marginr form-control1" id="images" name="images[]" multiple>
                                                                <button class="btn btn-outline-secondary rounded incrementBtn1" id="incrementBtn1" type="button">+</button>
                                                                <button class="btn btn-outline-secondary rounded decrementBtn1" style="display: none" type="button">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" id="colorContainer">
                                                            <label for="productColor" class="form-label">Product Color(Up to 7)
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group input-group2 mb-3">
                                                                <input type="file" class="form-control rounded marginr form-control2" id="productColor" name="product_color_images[]" multiple>
                                                                <input type="text" class="form-control rounded marginr form-control21" id="productColor1" name="product_color_names[]" multiple placeholder="color name">
                                                                <button class="btn btn-outline-secondary rounded incrementBtn2" id="incrementBtn2" type="button">+</button>
                                                                <button class="btn btn-outline-secondary rounded decrementBtn2" type="button" style="display: none;">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12" id="featuresContainer">
                                                            <label for="productColor" class="form-label">Feature(optional)</label>
                                                            <div class="input-group input-group3 mb-3">
                                                                <input type="text" class="form-control rounded marginr form-control3" id="productColor" name="product_feature_keys[]" multiple placeholder="key">
                                                                <input type="text" class="form-control rounded marginr form-control31" id="productColor1" name="product_feature_values[]" multiple placeholder="value">
                                                                <button class="btn btn-outline-secondary rounded incrementBtn3" id="incrementBtn3" type="button">+</button>
                                                                <button class="btn btn-outline-secondary rounded decrementBtn3" type="button" style="display: none;">-</button>
                                                            </div>
                                                        </div>
                                                        <div class="col-12">
                                                            <label for="productColor" class="form-label">Description
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <textarea id="summernote" name="description">
                                                                <p>Product Description</p>
                                                            </textarea>
                                                        </div>
                                                        <div class="text-center" style="margin-top: 130px;">
                                                            <button type="submit" class="btn btn-primary">
                                                                Submit
                                                            </button>
                                                            <button type="reset" class="btn btn-secondary">
                                                                Reset
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <th scope="row">{{$product['id']}}</th>
                                        <td>{{$product['name']}}</td>
                                        <td>{{$product['quantity']}}</td>
                                        <td>{{$product['price']}}</td>
                                        <td>{{$product['created_at']}}</td>
                                        <td>{{$product['updated_at']}}</td>
                                        <td>
                                            <button type="button" class="btn p-0 marginl" data-toggle="modal" data-target="#delete'.{{$product['id']}}.'">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <a href="{{route('backend.product.edit', ['id' => $product['id']])}}" class="btn p-0 marginl">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                            <button type="button" class="btn p-0 marginl" data-toggle="modal" data-target="#show'.{{$product['id']}}.'">
                                                <i class="bi bi-eye"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete'.{{$product['id']}}.'" tabindex="-1"
                                         role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                                    <div class="modal fade" id="show'.{{$product['id']}}.'" tabindex="-1"
                                         role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="card-title"></h5>
                                                    <button type="button" class="btn close" data-dismiss="modal"
                                                            aria-label="Close">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </div>
                                                <div class="card-body">
                                                    <div class="modal-body row g-3">
                                                        <div class="col-md-6">
                                                            <label for="inputName5" class="form-label">Name</label>
                                                            <p class="form-control">{{$product['name']}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="inputName5" class="form-label">Quantity</label>
                                                            <p class="form-control">{{$product['quantity']}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="inputName5" class="form-label">Price</label>
                                                            <p class="form-control">{{$product['price']}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brand_id" class="form-label">Brand</label>
                                                            <p class="form-control">{{$product['name']}}</p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brand_id" class="form-label">Categories</label>
                                                            <p class="form-control">
                                                                @foreach($product->categories as $product_category)
                                                                    {{$product_category['name']}},
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brand_id" class="form-label">Sizes</label>
                                                            <p class="form-control">
                                                                @foreach($product->sizes as $product_size)
                                                                    {{$product_size['name']}},
                                                                @endforeach
                                                            </p>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brand_id" class="form-label">Images</label>
                                                            <div>
                                                                @foreach($product->images as $product_image)
                                                                    <a href="{{route('backend.product.showImage', ['image' => $product_image['image']])}}">
                                                                        <img src="{{asset('/'.\App\Const\ImageFolderPath::PRODUCT.'/'.$product_image['image'])}}" alt="product_image" width="70" height="70" class="rounded border object-fit-cover">
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label for="brand_id" class="form-label">Product Colors</label>
                                                            <div class="row">
                                                                @foreach($product->colors as $product_color)
                                                                    <a href="{{route('backend.product.showImage', ['image' => $product_color['image']])}}" class="form-control m-1 d-flex" style="max-width: 170px;">
                                                                        <img src="{{asset('/'.\App\Const\ImageFolderPath::PRODUCT_COLOR.'/'.$product_color['image'])}}" alt="product_image" width="50" height="50" class="rounded object-fit-cover">
                                                                        <span class="px-2">{{$product_color['name']}}</span>
                                                                    </a>
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="brand_id" class="form-label">Product Features</label>
                                                                @foreach($product->features as $product_feature)
                                                                    <div class="form-control mb-1">
                                                                        {{$product_feature['key']}} - {{$product_feature['value']}}
                                                                    </div>
                                                                @endforeach
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="brand_id" class="form-label">Product Description</label>
                                                            <div class="form-control mb-1">
                                                               {!! $product['description'] !!}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('script')
    <script>
        new MultiSelectTag('product_categories_create', {
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
        new MultiSelectTag('product_sizes_create', {
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
                const currentInputs = container.querySelectorAll('.input-group1').length;

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
            $('#summernote').summernote();
        });
    </script>

@endsection
