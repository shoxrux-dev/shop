@extends('backend.layouts.layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Brand Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{route('backend.brand.index')}}">Brand</a></li>
                    <li class="breadcrumb-item active">Edit</li>
                </ol>
            </nav>
        </div>
        @if(session('message'))
            <div class="alert alert-warning alert-dismissible fade show col-lg-10" style="display: flex; justify-content: space-between; align-items: center" role="alert">
                <strong>{{session('message')}}</strong>
                <button type="button" class="btn close" data-dismiss="alert" aria-label="Close">
                    <i class="bi bi-x-circle"></i>
                </button>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show col-lg-10" style="display: flex; justify-content: space-between; align-items: center">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <section class="section">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <form class="row g-3 mt-3" method="POST" action="{{route('backend.brand.update', ['id' => $brand['id']])}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12 mb-3">
                                    <label for="name" class="form-label">
                                        Brand Name
                                    </label>
                                    <input type="text" name="name" value="{{$brand['name']}}" class="form-control" id="name" autofocus required>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="image" class="form-label">
                                        Brand Image
                                    </label>
                                    <input type="file" name="image" class="form-control" id="image" autofocus>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="brand_categories_edit" class="form-label">Category
                                        <span class="text-danger">*</span>
                                    </label>
                                    <div class="d-flex">
                                        <select name="categories[]" id="brand_categories_edit" multiple>
                                            @foreach($categories as $category)
                                                <option {{ $brand->categories->contains($category['id']) ? 'selected' : '' }} value="{{$category['id']}}">{{$category['name']}}</option>
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
                <div class="col-lg-4">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-12 mb-3">
                                @if(isset($brand['image']))
                                    <img src="{{asset('/'.App\Const\ImageFolderPath::BRAND.'/'.$brand['image'])}}" alt="category_image" width="350" height="350" style="object-fit: cover;">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection


@section('script')
    <script>
        new MultiSelectTag('brand_categories_edit', {
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
