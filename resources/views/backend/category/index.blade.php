@extends('backend.layouts.layout')

@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Category Page</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('backend.index')}}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Category</li>
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
                                <button type="button" class="btn btn-outline-dark" data-bs-toggle="modal" data-bs-target="#ExtralargeModal">
                                    <i class="bi bi-plus-circle"></i>
                                </button>
                                <div class="modal fade" id="ExtralargeModal" tabindex="-1">
                                    <div class="modal-dialog modal-md">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="card-title">Create New Category</h5>
                                                <button type="button" class="btn close" data-bs-dismiss="modal" aria-label="Close">
                                                    <i class="bi bi-x-circle"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="card-body">
                                                    <form class="row g-3" method="POST" action="{{route('backend.category.store')}}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="col-md-12">
                                                            <label for="inputName5" class="form-label">Name</label>
                                                            <input type="text" name="name" class="form-control" id="inputName5">
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="parent_id" class="form-label">Parent Category</label>
                                                            <select id="parent_id" name="parent_id" class="form-select">
                                                                <option value="">Select</option>
                                                                @foreach($allCategories as $category)
                                                                    <option value="{{$category['id']}}">{{$category['name']}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label for="inputPassword5" class="form-label">Image</label>
                                                            <input type="file" name="image" class="form-control" id="inputPassword5">
                                                        </div>
                                                        <div class="text-end">
                                                            <button type="submit" class="btn btn-primary">Submit</button>
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
                                    <th scope="col">Parent Category</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Updated At</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($categories as $category)
                                    <tr>
                                        <th scope="row">{{$category['id']}}</th>
                                        <td>{{$category['name']}}</td>
                                        <td>
                                            @if(isset($category['parent_id']))
                                                {{$category->parent['name']}}
                                            @endif
                                        </td>
                                        <td>
                                            @if(isset($category['image']))
                                                <img src="{{asset('/'.App\Const\ImageFolderPath::CATEGORY.'/'.$category['image'])}}" alt="category_image" style="object-fit: cover" width="25" height="25">
                                            @endif
                                        </td>
                                        <td>{{$category['created_at']}}</td>
                                        <td>{{$category['updated_at']}}</td>
                                        <td>
                                            <button type="button" class="btn p-0 marginl" data-toggle="modal" data-target="#delete'.{{$category['id']}}.'">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                            <button type="button" class="btn p-0 marginl" data-toggle="modal" data-target="#'.{{$category['id']}}.'">
                                                <i class="bi bi-pencil-square"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="delete'.{{$category['id']}}.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="card-title"></h5>
                                                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body d-flex justify-content-between">
                                                        <h4><span style="color: #946200">{{$category['name']}}</span> <br> Do you want to delete?</h4>
                                                        <div>
                                                            <a href="{{route('backend.category.delete', ['id' => $category['id']])}}" class="btn btn-danger">
                                                                delete
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="'.{{$category['id']}}.'" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-md">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="card-title">{{$category['name']}}</h5>
                                                    <button type="button" class="btn close" data-dismiss="modal" aria-label="Close">
                                                        <i class="bi bi-x-circle"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="card-body">
                                                        <form class="row g-3 mt-2" method="POST" action="{{route('backend.category.update', ['id' => $category['id']])}}" enctype="multipart/form-data">
                                                            @csrf
                                                            <div class="col-md-12 mb-3">
                                                                <label for="inputName5" class="form-label">Name</label>
                                                                <input type="text" name="name" value="{{$category['name']}}" class="form-control" id="inputName5">
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="parent_id" class="form-label">Parent Category</label>
                                                                <select id="parent_id" name="parent_id" class="form-select">
                                                                    @if(isset($category['parent_id']))
                                                                        <option value="{{$category['parent_id']}}">{{$category->parent['name']}}</option>
                                                                    @else
                                                                        <option value="">Select</option>
                                                                    @endif
                                                                    @foreach($allCategories as $allCategoryItem)
                                                                        <option value="{{$allCategoryItem['id']}}">{{$allCategoryItem['name']}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                <label for="inputPassword5" class="form-label">Image</label>
                                                                <input type="file" name="image" class="form-control" id="inputPassword5">
                                                            </div>
                                                            <div class="col-md-12 mb-3">
                                                                @if(isset($category['image']))
                                                                    <img src="{{asset('/'.App\Const\ImageFolderPath::CATEGORY.'/'.$category['image'])}}" alt="category_image" style="object-fit: cover; width: 100%">
                                                                @endif
                                                            </div>
                                                            <div class="text-end">
                                                                <button type="submit" class="btn btn-primary">Submit</button>
                                                            </div>
                                                        </form>
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
