@extends('frontend.layouts.layout')
@section('content')
            <main class="main">
                <nav aria-label="breadcrumb" class="breadcrumb-nav mb-3">
                    <div class="container">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('frontend.index')}}">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </div>
                </nav>

                <div class="page-content">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="cat-blocks-container">
                                    <div class="row">
                                        @foreach($categories as $category)
                                            <div class="col-6 col-md-4 col-lg-2">
                                                <a href="{{route('frontend.category.products', ['slug' => $category['slug']])}}" class="cat-block">
                                                    <figure>
                                                        <span>
                                                            <img src="{{asset('/'.App\Const\ImageFolderPath::CATEGORY.'/'.$category['image'])}}" alt="category_image">
                                                        </span>
                                                    </figure>

                                                    <h3 class="cat-block-title">{{$category['name']}}</h3>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="mb-2"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>

@endsection
