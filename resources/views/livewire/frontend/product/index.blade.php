<div>
    <div class="row">
        <div class="col-md-3">
            <div class="card">
                @if($category->brands)
                <div class="card-header"><h4>Brands</h4></div>
                <div class="card-body">
                    @foreach ($category->brands as $brandItem )
                    <label class="d-block">
                        <input type="checkbox" wire:model="brandInputs" value="{{$brandItem->name}}"> {{$brandItem->name}}
                    </label>
                    @endforeach
                </div>
                @endif
            </div>

            <div class="card mt-3">
                @if($category->brands)
                <div class="card-header"><h4>Price</h4></div>
                <div class="card-body">
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInputs" value="high-to-low"> High to low
                    </label>
                    <label class="d-block">
                        <input type="radio" name="priceSort" wire:model="priceInputs" value="low-to-high"> Low to high
                    </label>
                </div>
                @endif
            </div>

        </div>

        <div class="col-md-9">

            <div class="row">
                
                @forelse ($products as $productItem )
                        
                <div class="col-md-4">
                    <div class="product-card">
                        <div class="product-card-img">
                            @if ($productItem->quantity > 0)
                            <label class="stock bg-success">In Stock</label>
                            @else
                            <label class="stock bg-danger">Out Of Stock</label>
                            @endif

                            @if ($productItem->productimages->count() > 0)
                            <a href="{{url('/collections/'.$productItem->category->slug.'/'.$productItem->slug)}}">
                            <img src="{{asset($productItem->productimages{0}->image)}}" alt="{{$productItem->name}}" style="height: 200px">
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

                @empty
                <div class="col-md-12">
                    <div class="p-2">
                        <h4>No Products Found for {{$category->name}}</h4>
                    </div>
                </div>
                @endforelse
            </div>
       </div>

    </div>
</div>
