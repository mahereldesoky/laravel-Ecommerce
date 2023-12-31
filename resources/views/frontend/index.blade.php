@extends('layouts.app')

@section('title','WorkCrafts Home Page')

@section('content')

<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">

    <div class="carousel-inner" data-bs-interval="2000">

        @foreach ($sliders as $key => $sliderItem )
            
            <div class="carousel-item {{$key == 0 ? 'active' : ''}}" data-bs-interval="2000">
                @if($sliderItem->image)
                <img src="{{asset("$sliderItem->image")}}" style="height:500px" class="d-block w-100" alt="slider">
                @endif
            <div class="carousel-caption d-none d-md-block">
              <div class="custom-carousel-content">
                  <h1>
                    {!!$sliderItem->title!!}
                  </h1>
                  <p>
                      {!!$sliderItem->description!!} </p>
                  <div>
                      <a href="#" class="btn btn-slider">
                          Get Now
                      </a>
                  </div>
              </div>
              </div>
          </div>
        @endforeach

    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>

  </div>


  <div class="py-5 bg-white">
    <div class="container">
      <div class="row justify-content-center align-items-center">
        <div class="col-md-8 text-center">
          <h4>Welcome To WorkCraft</h4>
          <div class="underline mx-auto "></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Mollitia soluta laudantium quod vero ex magnam ea rem animi recusandae? Iusto quasi ipsam tempora dolorem sit dicta autem veritatis cum obcaecati.</p>
        </div>
          

      </div>
    </div>
  </div>

  <div class="py-5 ">
    <div class="container">
      <div class="row">

        <div class="col-md-12">
          <h4>Trending Products</h4>
          <div class="underline mb-3"></div>
        </div>



        @if($trandingProducts)
          <div class="col-md-12 ">
            <div class="owl-carousel owl-theme trending-products ">

              @foreach ($trandingProducts as $productItem )

                <div class="item">
                  <div class="product-card">
                    <div class="product-card-img">
                        <label class="stock bg-danger">New</label>


                        @if ($productItem->productimages->count() > 0)
                        <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                        <img src="{{asset($productItem->productimages{0}->image)}}" alt="{{$productItem->name}}" style="height: 250px">
                        </a>
                        @endif
                    </div>
                    <div class="product-card-body">
                        <p class="product-brand">{{$productItem->brand}}</p>
                        <h5 class="product-name">
                        <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                            {{$productItem->name}}
                        </a>
                        </h5>
                        <div>
                            <span class="selling-price">${{$productItem->selling_price}}</span>
                            <span class="original-price">${{$productItem->original_price}}</span>
                        </div>

                    </div>
                  </div>
                </div>
                @endforeach

            </div>

          </div>

        @else

          <div class="col-md-12">
            <div class="p-2">
                <h4>No Products Found </h4>
            </div>
          </div>
        @endif


      </div>
    </div>
  </div>

  


@endsection


@push('scripts')
  


<script>

    $('.owl-carousel').owlCarousel({
    loop:true,
    margin:10,
    nav:true,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4
        }
    }
})
</script>

@endpush
