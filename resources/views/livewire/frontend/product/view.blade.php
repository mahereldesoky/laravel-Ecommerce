<div>
    <div class="py-3 py-md-5 ">
        <div class="container">
            
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>
            
            <div class="row" >
                <div class="col-md-5 mt-3" wire:ignore>
                    <div class="bg-white border" >
                        @if($product->productImages)
                        <div class="exzoom" id="exzoom">
                            <!-- Images -->
                            <div class="exzoom_img_box">
                              <ul class='exzoom_img_ul'>
                                @foreach ($product->productImages as $itemImage)
                                    <li><img src="{{asset($itemImage->image)}}"/></li>
                                @endforeach
                              </ul>
                            </div>
                            <div class="exzoom_nav"></div>
                            <p class="exzoom_btn">
                                <a href="javascript:void(0);" class="exzoom_prev_btn"> < </a>
                                <a href="javascript:void(0);" class="exzoom_next_btn"> > </a>
                            </p>
                          </div>
                        @else
                        No image added
                        @endif
                    </div>
                </div>
                <div class="col-md-7 mt-3">
                    <div class="product-view">
                        <h4 class="product-name">
                            {{$product->name}}
                        </h4>
                        <hr>
                        <p class="product-path">
                            Home / {{$product->category->name}} / {{$product->name}}
                        </p>
                        <div>
                            <span class="selling-price">{{$product->selling_price}}$</span>
                            <span class="original-price">{{$product->original_price}}$</span>
                        </div>
                        <div>
                            @if($product->productColors->count() > 0)
                                @if($product->productColors)
                                    @foreach ($product->productColors as $colorItem )
                                        <label class="colorSelectionLabel btn btn-sm  " style="background-color:{{$colorItem->color->code}} ; color:{{$colorItem->color->code}} ; border-dadius:50%;"
                                            wire:click="colorSelected ({{$colorItem->id}}) "
                                            >
                                            {{$colorItem->color->name}}
                                        </label>
                                    @endforeach
                                @endif

                                <div>
                                    @if ($this->productColorSelectedQuantity == 'outofStock')
                                        <label class="btn btn-sm py-1 mt-2 text-white bg-danger" >Out of Stock</label>
                                    @elseif ($this->productColorSelectedQuantity > 0)
                                        <label class="btn btn-sm p-1 mt-2 text-white bg-success" >In Stock</label>
                                    @endif
                                </div>

                                @else
                                @if($product->quantity)
                                <label class="btn-sm p-1 mt-2 text-white bg-success" >In Stock</label>
                                @else
                                <label class="btn-sm py-1 mt-2 text-white bg-danger" >Out of Stock</label>
                                @endif
                            @endif




                        </div>
                        <div class="mt-2">
                            <div class="input-group">
                                <span class="btn btn1" wire:click="incrementQuantity"><i class="fa fa-minus"></i></span>
                                <input type="text" wire:model="quantityCount" value="{{$this->quantityCount}}" readonly class="input-quantity" />
                                <span class="btn btn1" wire:click="decrementQuantity"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                        <div class="mt-2">
                            <a href="" class="btn btn1" wire:click="addToCart({{$product->id}})"> 
                                <i class="fa fa-shopping-cart"></i> Add To Cart
                            </a>
                            <button type="button" wire:click="addToWishList({{$product->id}})" class="btn btn1">
                                <span wire:loading.remove wire:target="addToWishList">
                                    <i class="fa fa-heart"></i> Add To Wishlist 
                                </span>
                                <span wire:loading wire:target="addToWishList">Adding...</span>
                            </button>
                        </div>
                        <div class="mt-3">
                            <h5 class="mb-0">Small Description</h5>
                            <p>
                                {!!$product->small_description!!}                            
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-3">
                    <div class="card">
                        <div class="card-header bg-white">
                            <h4>Description</h4>
                        </div>
                        <div class="card-body">
                            <p>
                                {!!$product->description!!}                            
                             </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


@push('scripts')

<script>
    $(function(){

    $("#exzoom").exzoom({

        // thumbnail nav options
        "navWidth": 60,
        "navHeight": 60,
        "navItemNum": 5,
        "navItemMargin": 7,
        "navBorder": 1,

        // autoplay
        "autoPlay": false,

        // autoplay interval in milliseconds
        "autoPlayTimeout": 2000
        
        });

    });
</script>

@endpush