<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->

<head>
  <title>@yield('title', 'Home') | Mi Calle</title>
  <!-- [Meta] -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="Mantis is made using Bootstrap 5 design framework. Download the free admin template & use it for your project.">
  <meta name="keywords" content="Mantis, Dashboard UI Kit, Bootstrap 5, Admin Template, Admin Dashboard, CRM, CMS, Bootstrap Admin Template">
  <meta name="author" content="CodedThemes">

  <!-- [Favicon] icon -->
  <link rel="icon" href="{{ asset('plantilla/assets/images/favicon.svg') }}" type="image/x-icon">
  <!-- [Google Font] Family -->
<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700&display=swap" id="main-font-link">
<link rel="stylesheet" href="{{ asset('plantilla/src/assets/fonts/tabler-icons.min.css') }}">
<link rel="stylesheet" href="{{ asset('plantilla/src/assets/fonts/feather.css') }}">
<link rel="stylesheet" href="{{ asset('plantilla/src/assets/fonts/fontawesome.css') }}">
<link rel="stylesheet" href="{{ asset('plantilla/src/assets/fonts/material.css') }}">
<!-- [Template CSS Files] -->
<link rel="stylesheet" href="{{ asset('plantilla/dist/assets/css/style.css') }}" id="main-style-link">
<link rel="stylesheet" href="{{ asset('plantilla/dist/assets/css/style-preset.css') }}">
@stack('styles')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->

<body data-pc-preset="preset-1" data-pc-direction="ltr" data-pc-theme="light">
  <!-- [ Pre-loader ] start -->
<div class="loader-bg">
  <div class="loader-track">
    <div class="loader-fill"></div>
  </div>
</div>
<!-- [ Pre-loader ] End -->
 <!-- [ Sidebar Menu ] start -->
@include('partials.sidebar')

<!-- [ Sidebar Menu ] end --> <!-- [ Header Topbar ] start -->

<!-- [Mobile Media Block end] -->

 </div>
</header>
<!-- [ Header ] end -->
    @include('partials.header')


  <!-- [ Main Content ] start -->
  <div class="pc-container">
    <div class="pc-content">
      <!-- [ breadcrumb ] start -->
      <div class="page-header">
        <div class="page-block">
          <div class="row align-items-center">
         
          </div>
        </div>
      </div>
      <!-- [ breadcrumb ] end -->
      <!-- [ Main Content ] start -->
      <div class="row">
        <!-- [ sample-page ] start -->
        <div class="col-sm-12">
          <div class="card">
            <div class="card-header">
              <h5>@yield('title', 'Home')</h5>
            </div>
            <div class="card-body">
              @yield('content')
            </div>
          </div>
        </div>
        <!-- [ sample-page ] end -->
      </div>
     
        
  <!-- [ Main Content ] end -->
    @include('partials.footer')

  <!-- [Page Specific JS] start -->
<script src="{{ asset('plantilla/dist/assets/js/plugins/apexcharts.min.js') }}"></script>
<script src="{{ asset('plantilla/dist/assets/js/pages/dashboard-default.js') }}"></script>

<script src="{{ asset('plantilla/dist/assets/js/plugins/popper.min.js') }}"></script>
<script src="{{ asset('plantilla/dist/assets/js/plugins/simplebar.min.js') }}"></script>
<script src="{{ asset('plantilla/dist/assets/js/plugins/bootstrap.min.js') }}"></script>
<script src="{{ asset('plantilla/dist/assets/js/fonts/custom-font.js') }}"></script>
<script src="{{ asset('plantilla/dist/assets/js/pcoded.js') }}"></script>
<script src="{{ asset('plantilla/dist/assets/js/plugins/feather.min.js') }}"></script>

  
  
  
  
  <script>layout_change('light');</script>
  
  
  
  
  <script>change_box_container('false');</script>
  
  
  
  <script>layout_rtl_change('false');</script>
  
  
  <script>preset_change("preset-1");</script>
  
  
  <script>font_change("Public-Sans");</script>
  @stack('scripts')
    

</body>
<!-- [Body] end -->

</html>