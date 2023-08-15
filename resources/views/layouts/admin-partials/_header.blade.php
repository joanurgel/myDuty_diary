<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/icon/dry.ico') }}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- jquery --}}
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{ asset('vendor/css/dropify.min.css')}}">
    <!-- Styles -->
    <link href="{{ asset('vendor/css/sb-admin-2.min.css') }}" rel="stylesheet">


    {{-- SB Admin Assets --}}
    <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/0371f381a6.js" crossorigin="anonymous"></script>
    
    <!-- SweetAlert and jQuery imports inside the <head> section -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.min.css">
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.0.19/dist/sweetalert2.all.min.js"></script>

   {{-- jquery --}}
   <script src="{{ asset('vendor/css.dropify.min.css') }}"></script>
   <script src="{{ asset('vendor/js/dropify.min.js') }}"></script>

   <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
   {{-- <script src="{{ asset('vendor/js.lightbox.js') }}"></script> --}}

   {{-- datatables --}}
   <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

   {{-- TinyMCE --}}
   {{-- <script src="https://cdn.tiny.cloud/1/f91h8ob9cbvkiqq7t8c04i5g7mpzus8bufl7tdxkfq8cydqj/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
</head>
<body id="page-top">