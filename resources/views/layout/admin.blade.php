<!DOCTYPE html>
<html @if(LaravelLocalization::getCurrentLocale() == 'en') lang="en" @else direction="rtl" dir="rtl"
      style="direction: rtl" @endif>
<!--begin::Head-->
<head>
    <base href="">
    <title>Luxury Gift</title>
    <meta charset="utf-8"/>
    <meta name="description"
          content="The most advanced Bootstrap Admin Theme on Themeforest trusted by 94,000 beginners and professionals. Multi-demo, Dark Mode, RTL support and complete React, Angular, Vue &amp; Laravel versions. Grab your copy now and get life-time updates for free."/>
    <meta name="keywords"
          content="Metronic, bootstrap, bootstrap 5, Angular, VueJs, React, Laravel, admin themes, web design, figma, web development, free templates, free admin themes, bootstrap theme, bootstrap template, bootstrap dashboard, bootstrap dak mode, bootstrap button, bootstrap datepicker, bootstrap timepicker, fullcalendar, datatables, flaticon"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <meta property="og:locale" content="en_US"/>
    <meta property="og:type" content="article"/>
    <meta property="og:title"
          content="Metronic - Bootstrap 5 HTML, VueJS, React, Angular &amp; Laravel Admin Dashboard Theme"/>
    <meta property="og:url" content="https://keenthemes.com/metronic"/>
    <meta property="og:site_name" content="Keenthemes | Metronic"/>
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8"/>
    <link rel="shortcut icon" href="{{asset('admin-assets/media/logos/dpmhomes.ico')}}"/>
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <!--end::Fonts-->
    @if(LaravelLocalization::getCurrentLocale() == 'en')
        @if(Session::get('mode') == 'Dark')
            <!--begin::Global Stylesheets Bundle(used by all pages)-->
            <link href="{{asset('admin-assets/plugins/global/plugins.dark.bundle.css')}}" rel="stylesheet"
                  type="text/css"/>
            <link href="{{asset('admin-assets/css/style.dark.bundle.css')}}" rel="stylesheet" type="text/css"/>
            <!--end::Global Stylesheets Bundle-->
        @else
            <!--begin::Global Stylesheets Bundle(used by all pages)-->
            <link href="{{asset('admin-assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet"
                  type="text/css"/>
            <link href="{{asset('admin-assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
            <!--end::Global Stylesheets Bundle-->
        @endif
    @else
        @if(Session::get('mode') == 'Dark')
            <!--begin::Global Stylesheets Bundle(used by all pages)-->
            <link href="{{asset('admin-assets/plugins/global/plugins.dark.bundle.rtl.css')}}" rel="stylesheet"
                  type="text/css"/>
            <link href="{{asset('admin-assets/css/style.dark.bundle.rtl.css')}}" rel="stylesheet"
                  type="text/css"/>
            <!--end::Global Stylesheets Bundle-->
        @else
            <!--begin::Global Stylesheets Bundle(used by all pages)-->
            <link href="{{asset('admin-assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet"
                  type="text/css"/>
            <link href="{{asset('admin-assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
            <!--end::Global Stylesheets Bundle-->
        @endif
    @endif


    @stack('css')
</head>
<!--end::Head-->
<!--begin::Body-->
<body id="kt_body"
      class="@if(Session::get('mode') == 'Dark') dark-mode @endif header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed toolbar-tablet-and-mobile-fixed aside-enabled aside-fixed"
      style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px">
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">
        @include('partials.admin.sidebar')
        <!--begin::Wrapper-->
        <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
            @include('partials.admin.header')
            <!--begin::Content-->
            @yield('content')
            <!--end::Content-->
            @include('partials.admin.footer')
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--end::Main-->
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
					<rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                          fill="black"/>
					<path
                        d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                        fill="black"/>
				</svg>
			</span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->

<!--begin::Javascript-->
<script>var hostUrl = "assets/";</script>
<!--begin::Global Javascript Bundle(used by all pages)-->
<script src="{{asset('admin-assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Javascript Bundle-->

<!--end::Page Vendors Javascript-->
<!--begin::Page Custom Javascript(used by this page)-->
<script src="{{asset('admin-assets/js/widgets.bundle.js')}}"></script>
<script src="{{asset('admin-assets/js/custom/widgets.js')}}"></script>
@include('sweetalert::alert')
@stack('js')
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->
</html>
