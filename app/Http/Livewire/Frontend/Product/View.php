<?php

namespace App\Http\Livewire\Frontend\Product;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class View extends Component
{
    public $category, $product,$productColorSelectedQuantity,$quantityCount=1,$productColorId;

    public function addToWishList($productId)
    {
        if(Auth::check()){
            if(Wishlist::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists()){
                session()->flash('message','Already added to wishlist');
                $this->dispatchBrowserEvent('message', ['text' => 'Already added to wishlist',
                'type' => 'warning','status' => 409]);
                return false;
            }
            else{
                Wishlist::create([
                'user_id' => auth()->user()->id,
                'product_id' => $productId
            ]);
            $this->emit('wishlistAddedUpdated');
            session()->flash('message','wishlist Added successfully');
            $this->dispatchBrowserEvent('message', ['text' => 'wishlist Added successfully',
            'type' => 'success','status' => 200]);
            }
        }
        else {
            session()->flash('message','Please Login To continue');
            $this->dispatchBrowserEvent('message', ['text' => 'Please Login To continue',
            'type' => 'info','status' => 401]);
            return false;
        }
    }

    public function colorSelected($productColorId)
    {
        $this->productColorId = $productColorId;
         $productColor = $this->product->productColors()->where('id',$productColorId)->first();
        $this->productColorSelectedQuantity = $productColor->quantity;

        if($this->productColorSelectedQuantity == 0){
            $this->productColorSelectedQuantity = 'outofStock';
        }
    }

    public function mount($category, $product)
    {
        $this->category = $category;
        $this->product = $product;
    }

    public function decrementQuantity()
    {
        if($this->quantityCount <10) {
            $this->quantityCount++;
        }
    }

    public function incrementQuantity()
    {
        if($this->quantityCount > 1) {
            $this->quantityCount--;
        }

    }

    public function addToCart(int $productId)
    {
        if(Auth::check())
        {
            if($this->product->where('id',$productId)->where('status','0')->exists())
            {
                // check color quan and inser to cart
                if($this->product->productColors()->count() > 1)
                {
                    if($this->productColorSelectedQuantity != NuLL)
                    {
                        if(Cart::where('user_id',auth()->user()->id)
                                ->where('product_color_id',$this->productColorId)
                                ->where('product_id',$productId)
                                ->exists())
                        {
                            $this->dispatchBrowserEvent('message', ['text' => 'Product Already Added',
                            'type' => 'warning','status' => 200]);
                        }
                        else
                        {

                            $productColor = $this->product->productColors()->where('id',$this->productColorId)->first();
                            if($productColor->quantity > 0)
                            {
                                if($productColor->quantity > $this->quantityCount)
                                {
                                    // Insert to cart 
                                    Cart::create([
                                        'user_id' => auth()->user()->id,
                                        'product_id' => $productId,
                                        'product_color_id' => $this->productColorId,
                                        'quantity' => $this->quantityCount
                                    ]);

                                    $this->emit('cartAddedUpdated');
                                    $this->dispatchBrowserEvent('message', ['text' => 'product added to cart',
                                    'type' => 'success','status' => 200]);
        
                                }
                                else
                                {
                                    $this->dispatchBrowserEvent('message', ['text' => 'Only'.$productColor->quantity.'Quantity Avaliable',
                                    'type' => 'warning','status' => 409]);
                                }
                            }
                            else 
                            {
                                $this->dispatchBrowserEvent('message', ['text' => 'Out of stock',
                                'type' => 'warning','status' => 404]);
                            }
                        }

                    }
                    else 
                    {
                        $this->dispatchBrowserEvent('message', ['text' => 'Select product color',
                        'type' => 'info','status' => 409]);
                    }
                }
                else
                {

                    if(Cart::where('user_id',auth()->user()->id)->where('product_id',$productId)->exists())
                    {
                        $this->dispatchBrowserEvent('message', ['text' => 'Product Alreay Added',
                        'type' => 'warning','status' => 200]);
                    }
                    else 
                    {

                        if($this->product->quantity > 0)
                        {
                            if($this->product->quantity > $this->quantityCount)
                            {
                                // Insert to cart 
                                Cart::create([
                                    'user_id' => auth()->user()->id,
                                    'product_id' => $productId,
                                    'quantity' => $this->quantityCount
                                ]);
                                $this->emit('cartAddedUpdated');
                                $this->dispatchBrowserEvent('message', ['text' => 'product added to cart',
                                'type' => 'success','status' => 200]);

                            }
                            else
                            {
                                $this->dispatchBrowserEvent('message', ['text' => 'only'.$this->product->quantity.'Quantity Avaliable',
                                'type' => 'warning','status' => 409]);
                            }
                        }
                        else
                        {
                            $this->dispatchBrowserEvent('message', ['text' => 'out of stock',
                            'type' => 'warning','status' => 409]);
                        }
                    }

                }

            }
            else
            {
                $this->dispatchBrowserEvent('message', ['text' => 'Product not found',
                'type' => 'warning','status' => 409]);
            }
        }

        else 
        {
            $this->dispatchBrowserEvent('message', ['text' => 'please log in in to Add to cart',
            'type' => 'info','status' => 401]);
        }
    }


    public function render()
    {
        return view('livewire.frontend.product.view',[
            'category' => $this->category,
            'product' => $this->product,
        ]);

    }
}
