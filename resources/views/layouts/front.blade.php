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

    {{-- Google fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mukta&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('Frontent/js/custom.js') }}"></script>
    <script src="{{ asset('Frontent/js/checkout.js') }}"></script>

    
    <style>
        a {
            text-decoration: none !important;
            color: black;
            font-size: 20px;
        }
    </style>

</head>

<body>

    @include('layouts.inc.frontnavbar')
    <div class="content">
        @yield('content')
    </div>

{{-- 
    <script src="{{ asset('Frontent/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('Frontent/js/matirialize.min.js') }}"></script>
   --}}


    

    {{-- search product --}}
    
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
