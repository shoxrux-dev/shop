<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Shop') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <!-- Vendor CSS Files -->
    <link href="{{asset('backend/assets/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/bootstrap-icons/bootstrap-icons.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/boxicons/css/boxicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/quill/quill.snow.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/quill/quill.bubble.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/remixicon/remixicon.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/vendor/simple-datatables/style.css')}}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{asset('backend/assets/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/css/custom.css')}}" rel="stylesheet">
    <link href="{{asset('backend/assets/css/virtual-select.min.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
    <script src="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/js/multi-select-tag.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">

{{--    <style>--}}
{{--        .product-characteristics {--}}
{{--            max-width: 400px;--}}
{{--            margin: 0 auto;--}}
{{--        }--}}

{{--        .product-characteristics h2 {--}}
{{--            font-size: 24px;--}}
{{--            color: #333;--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .product-characteristics ul {--}}
{{--            list-style-type: none;--}}
{{--            padding: 0;--}}
{{--        }--}}

{{--        .product-characteristics li {--}}
{{--            margin-bottom: 10px;--}}
{{--        }--}}

{{--        .product-characteristics .attribute {--}}
{{--            font-weight: bold;--}}
{{--            margin-right: 10px;--}}
{{--        }--}}

{{--        .product-characteristics .line {--}}
{{--            display: inline-block;--}}
{{--            width: 100px; /* Adjust the width as needed */--}}
{{--            border-bottom: 1px solid #888888; /* Line style */--}}
{{--            margin-right: 10px; /* Spacing between line and value */--}}
{{--        }--}}

{{--        .product-characteristics .value {--}}
{{--            font-weight: bold;--}}
{{--        }--}}
{{--        <div class="product-characteristics">--}}
{{--        <h2>Product Characteristics</h2>--}}
{{--        <ul>--}}
{{--        <li><span class="attribute">Color:</span> <span class="line"></span> <span class="value">black</span></li>--}}
{{--        <li><span class="attribute">Size:</span> <span class="line"></span> <span class="value">24</span></li>--}}
{{--        <!-- Add more characteristics here -->--}}
{{--        </ul>--}}
{{--        </div>--}}
{{--    </style>--}}
</head>
<body>

<!-- ======= Header ======= -->
@include('backend.layouts.includes.header')

<!-- ======= Sidebar ======= -->
@include('backend.layouts.includes.sidebar')

@yield('content')

<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
    <div class="copyright">
        &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
         Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
</footer>

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script src="{{asset('backend/assets/vendor/apexcharts/apexcharts.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/chart.js/chart.umd.js')}}"></script>
<script src="{{asset('backend/assets/vendor/echarts/echarts.min.js')}}"></script>
<script src="{{asset('backend/assets/vendor/simple-datatables/simple-datatables.js')}}"></script>

<!-- Template Main JS File -->
<script src="{{asset('backend/assets/js/main.js')}}"></script>
<script src="{{asset('backend/assets/js/virtual-select.min.js')}}"></script>
<script src="{{asset('backend/assets/js/custom.js')}}"></script>

<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>



@yield('script')

</body>

</html>
