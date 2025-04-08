@extends('backend.layouts.layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Brand Page</h1>
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
            <div class="alert alert-danger alert-dismissible fade show col-lg-8" style="display: flex; justify-content: space-between; align-items: center">
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
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal"
                                        data-bs-target="#ExtralargeModal">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="card-title">Create New Brand</h5>
                                                <button type="button" class="btn close" data-bs-dismiss="modal"
                                                        aria-label="Close">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form class="row g-3" method="POST" action="{{route('backend.brand.store')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <label for="name" class="form-label">Brand Name <span class="text-danger">*</span></label>
                                                            <input type="text" name="name" class="form-control" id="name" autofocus required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="image" class="form-label">Image <span class="text-danger">*</span></label>
                                                            <input type="file" class="form-control rounded" id="image" name="image" required>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="brand_categories_create" class="form-label">Category
                                                                <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="d-flex">
                                                                <select name="categories[]" id="brand_categories_create" multiple>
                                                                    @foreach($categories as $category)
                                                                        <option value="{{$category['id']}}">{{$category['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="text-center">
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
                                    <th scope="col">Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($brands as $brand)
                                    <tr>
                                        <th scope="row">{{$brand['id']}}</th>
                                        <td>{{$brand['name']}}</td>
                                        <td>
                                            <img src="{{asset('/'.App\Const\ImageFolderPath::BRAND.'/'.$brand['image'])}}" alt="brand_image" style="object-fit: cover" width="25" height="25">
                                        </td>
                                        <td>{{$brand['created_at']}}</td>
                                        <td>{{$brand['updated_at']}}</td>
                                        <td>
                                            <button type="button" class="btn p-0 marginl" data-toggle="modal" data-target="#delete'.{{$brand['id']}}.'">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <a href="{{route('backend.brand.edit', ['id' => $brand['id']])}}" class="btn p-0 marginl">
                                                <i class="bi bi-pencil-square"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete'.{{$brand['id']}}.'" tabindex="-1"
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
                                                        <h4><span style="color: #946200">{{$brand['name']}}</span>
                                                            <br> Do you want to delete?</h4>
                                                        <div>
                                                            <a href="{{route('backend.brand.delete', ['id' => $brand['id']])}}" class="btn btn-danger">
                                                                delete
                                                            </a>
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
        new MultiSelectTag('brand_categories_create', {
            rounded: true,    // default true
            placeholder: 'Search',  // default Search...
            tagColor: {
                textColor: '#000000',
                borderColor: '#888888',
                bgColor: '#f5f5f5',
            },
            onChange: function(values) {
                console.log(values)
            }
        });
    </script>

@endsection
