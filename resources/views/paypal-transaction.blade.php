@extends('layouts.app')
@section('content')
 


@if (session('message'))
<h5 class="alert alert-success" >{{session('message')}}</h5>          
@endif

    <!-- Replace "test" with your own sandbox Business account app client ID -->
    <!-- Set up a container element for the button -->
    {{-- <div id="paypal-button-container"></div>
 @push('scripts')
<script src="https://www.paypal.com/sdk/js?client-id=ASuCjWEL6HRiyyWJE-ZqcuzJSUq69zNEye_q4CYa5JqrG5JkD331k7KJzR-_sdik3dJdjWcNgS_zPlM0&currency=USD"></script>

    <script>
      paypal.Buttons({
      }).render('#paypal-button-container');
    </script> 

@endpush  --}}

@endsection
