<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> @yield('title') </title>
    <meta name="descriotion" content="@yield('meta_descriotion')" >
    <meta name="keywords" content="@yield('meta_keyword')" >
    <meta name="author" content="Worckcrafts" >

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    {{-- <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css"/> --}}
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"> --}}

    <!-- Scripts -->
    @vite(['resources\css\bootstrap.min.css'])
    @vite(['resources\css\style.css'])

    <link rel="stylesheet" href="{{asset('assets\css\bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets\css\style.css')}}">

    {{-- carousel --}}
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css')}}" integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{url('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css')}}" integrity="sha512-sMXtMNL1zRzolHYKEujM2AqCLUR9F2C4/05cdbxjjLSRvMQIciEPCQZo++nk7go3BtSuK9kfa/s+a4f4i5pLkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- exzoom --}}
    <link rel="stylesheet" href="{{asset('assets\exzoom\jquery.exzoom.css')}}" />
    
    @livewireStyles
    @livewireScripts 

</head>
<body>
    
    <div id="app">


        @include('layouts.inc.frontend.navbar')

        <main class="">
            @yield('content')
        </main>
    </div>

    @include('layouts.inc.frontend.footer')
    
    <script src="{{ URL::asset('resources\js\bootstrap.bundle.min.js') }}"></script>
    {{-- <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script> --}}
    <script>
        window.addEventListener('message', event => {
            if(event.detail){
                alertify.set('notifier','position', 'top-right');
                alertify.notify(event.detail.text,event.detail.type);
            }

    });
    </script>

@stack('script')
    <script
    src="{{url('https://code.jquery.com/jquery-3.6.4.min.js')}}"
    integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8="crossorigin="anonymous"></script>
    <script src="{{asset('assets/js/jquery-3.6.3.min.js')}}"> </script>
    <script src="{{asset('assets/js/bootstrap.bundle.min.js')}}"> </script>
    <script src="{{asset('resources/js/owl.carousel.min.js') }}"> </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
     integrity="sha512-bPs7Ae6pVvhOSiIcyUClR7/q2OAsRiovw4vAkX+zJbw3ShAeeqezq50RIIcIURq7Oa20rW2n2q+fyXBNcU9lrw==" 
     crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>


@stack('scripts')
    <script src="{{ URL::asset('assets\exzoom\jquery.exzoom.js') }}"></script>
    {{-- <script src="{{ asset('assets\js\bootstrap.js') }}"> </script> --}}
    {{-- <script src="{{ asset('resources\js\bootstrap.js') }}"> </script> --}}


    @vite(['resources/sass/app.scss']);


</body>
</html>
