<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title')
    </title>


    <!-- CSS Files -->
    <link href="{{ asset('Frontent/css/bootstrap5.css') }}" rel="stylesheet" />
    <link href="{{ asset('Frontent/css/matirialize.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('Frontent/css/custom.css') }}" rel="stylesheet" />
    <link href="{{ asset('Frontent/css/owl.carousel.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('Frontent/css/owl.theme.default.min.css') }}" rel="stylesheet" />

    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('Frontent/js/custom.js') }}"></script>
    <script src="{{ asset('Frontent/js/checkout.js') }}"></script>

    
    
    <style>
        body{
            background-color: #b7ddfc
        }
        a {
            text-decoration: none !important;
            color: black;
            font-size: 20px;
        }
        .dropdowns {
          position: relative;
          display: inline-block;
        }
        
        .dropdowns-content {
          display: none;
          position: absolute;
          background-color: #f9f9f9;
          min-width: 200px;
          box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
          padding: 15px 105px;
          z-index: 1;
        }
        
        .dropdowns:hover .dropdowns-content {
          display: block;
        }
    </style>


</head>

<body>

    @include('layouts.inc.frontnavbar')
    <div class="content">
        @yield('content')
    </div>


    

    {{-- search product --}}
    
    
    <script src="{{ asset('Frontent/js/owl.carousel.min.js') }}"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>

        var availableTags = [];
        $.ajax({
            method: "GET",
            url: "/product-list",
            success: function (response) {
                // console.log(response);
                starAutoComplete(availableTags)
            }
        });
        
        function starAutoComplete(availableTags)
        {
            $("#search_product").autocomplete({
               source: availableTags
            });
        }
        
    </script>


    {{-- sweet alert --}}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @if (session('status'))
        <script>
            swal("{{ session('status') }}");
        </script>
    @endif

    @yield('scripts')

</body>

</html>
