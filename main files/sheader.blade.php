<?php

use App\Http\Controllers\Controller;

$menuh = Controller::get_page_menu('header', 'en');
$menuf = Controller::get_page_menu('footer', 'en');

if (!isset($setting)) {
  $setting = Controller::get_settings('en');
}
?>
<!DOCTYPE html>

<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <meta name="theme-color" content="#4a4a4a">
  <link rel="preconnect" href="https://fonts.gstatic.com">
  <link rel="icon" href="{{URL::asset('public/images/favicon.png')}}">
  <link href="{{ URL::asset('public/css/styles.css')}}?12" rel="stylesheet">
  <script src="{{ URL::asset('public/js/jquery-3.4.1.min.js')}}"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet" />
  <title>Mollure</title>

  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet">

  <meta content="" name="description">
  <style type="text/css">
    nav a {
      text-decoration: none;
      color: inherit;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6,
    h1>span,
    h2>span,
    h3>span,
    h4>span,
    h5>span,
    h6>span,
    p,
    span,
    div,
    label,
    a,
    li {
      font-family: 'Playfair Display', serif !important;
    }
    .ml-primary {
    background: transparent !important;
    padding: 3px 17px !important;
}
  </style>
</head>

<body>
  <!--Navbar Start-->
  <nav class="container navbar navbar-desktop px-4 py-2 d-flex flex-column flex-lg-row align-items-center justify-content-between mb-5 mt-3">
    <div class="d-flex align-items-center mb-0 me-lg-4">
      <a href="{{ config('app.url') }}"><img src="{{ $setting['site_logo'] }}" alt="logo" style="    max-height: 70px;" />
        <!-- <span class="fs-5 fw-medium ms-1">Mollure</span> -->
      </a>
    </div>
    <div class="d-flex flex-wrap align-items-center justify-content-center fw-medium px-2 mx-auto">
      <!-- <span class="me-4"><a href="{{ route('home') }}#result_expert">@if(isset($menuh['result'])) {{$menuh['result']}} @else Thuis @endif</a></span>
        <span class="me-4"><a href="{{route('about-us')}}">@if(isset($menuh['about-us'])) {{$menuh['about-us']}} @else About Us @endif</a></span>
        <span class="me-4"><a href="{{route('home')}}#guarantee">@if(isset($menuh['guarantee'])) {{$menuh['guarantee']}} @else Garantie @endif</a></span>
        <span class="me-4"><a href="{{route('home')}}#price">@if(isset($menuh['price'])) {{$menuh['price']}} @else Prijs @endif</a></span>
        <span class="me-4"><a href="{{route('how-works')}}">@if(isset($menuh['how-it-works'])) {{$menuh['how-it-works']}} @else Hoe het werkt? @endif</a></span>
        <span class=""><a href="{{route('contact_us')}}">@if(isset($menuh['contact-us'])) {{$menuh['contact-us']}} @else Contact @endif</a></span> -->
    </div>
    <div class="d-flex flex-wrap justify-content-center align-items-center nav-auto-row">
      <div class="dropdown lang-btn me-2">

        @if(isset($huri) && $huri!='')
        <button class="ml-primary dropdown-toggle d-flex align-items-center" type="button" id="dropdownMenuButton1"
                data-bs-toggle="dropdown" aria-expanded="false">
                EN
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li class="p-2">
            <a href="{{$huri}}">NL</a>
          </li>
        </ul>
        @endif
      </div>

      @if(Route::currentRouteName() != 'service_detail')

      @if(session('salon_login')=='1')
      <div class="me-4 fs-6 fw-medium">
        <a style="text-decoration:none" href="{{route('dashboard')}}"><i class="ri-user-line"></i>{{session('salon_name')}}</a>
      </div>
      <a href="{{route('logout')}}" style="text-decoration:none">
        <button class="loginOutBTN d-flex align-items-center fw-medium p-1">
          <i class="ri-logout-box-line ms-2"></i>Sign Out
        </button>
      </a>
      @else
      <a href="{{route('login')}}" style="text-decoration:none">
        <button class="loginOutBTN d-flex align-items-center fs-6 fw-medium">
          <i class="ri-user-fill me-1 ms-2"></i>Sign In
        </button>
      </a>
      @endif

      @endif
    </div>
  </nav>
  <!-- Navbar End -->
  <!--Navbar Mobile start-->
  <nav class="navbar navbar-expand-lg navbar-light navbar-mobile">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <div class="d-flex align-items-center mb-2 me-lg-4">
          <img src="{{ URL::asset('public/images/logo.png')}}" alt="logo" />
          <span class="fs-3 fw-medium ms-1">Mollure</span>
        </div>
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse fs-4" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0 ps-3 ps-md-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">RESULT</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">MOLLURE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">GUARANTEE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">PRICE</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">HOW IT WORKS?</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">ABOUT US</a>
          </li>
        </ul>
        <div class="d-flex ps-3 ps-md-0">
          <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item dropdown mb-2">
              <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                En <img src="{{ URL::asset('public/images/united-kingdom.png')}}" alt="uk flag" height="24" width="24" class="ms-1" />
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#"> Ger <img src="{{ URL::asset('public/images/germany.png')}}" alt="germany flag" height="24" width="24" class="ms-1" /></a></li>
                <li><a class="dropdown-item" href="#"> Ind <img src="{{ URL::asset('public/images/india.png')}}" alt="india flag" height="24" width="24" class="ms-1" /></a></li>
              </ul>
            </li>
            <li class="nav-item mb-2">
              <a class="nav-link" href="{{route('dashboard')}}">MORGAN FREEMAN</a>
            </li>
            <li class="nav-item mb-2">
              <a href="{{route('login')}}" class="nav-link btn btn-outline-secondary d-flex align-items-center justify-content-center">
                <i class="ri-user-fill me-2"></i>Sign In
              </a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>
  <!--Navbar Mobile End-->