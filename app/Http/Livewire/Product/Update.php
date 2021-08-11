<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Update extends Component
{
    public $productId;
    public $name_product;
    public $code_product;
    public $price;

    protected $listeners = ['updateProduct'];

    protected $rules = [
        'name_product' => 'required|min:6',
        'code_product' => 'required',
        'price' => 'required',
    ];

    public function updateProduct($product){
        $this->productId = $product['id'];
        $this->name_product = $product['name_product'];
        $this->code_product = $product['code_product'];
        $this->price = $product['price'];
    }

    public function update()
    {
        $this->validate();

        if($this->productId){
            $product = Product::where('id',$this->productId)->first();
            $product->update([
                'name_product' => $this->name_product,
                'code_product' => $this->code_product,
                'price' => $this->price,
            ]);
        }

        $this->emit('newUpdateProduct',$product);

        $this->deleteInput();
    }

    public function deleteInput(){
        $this->name_product = null;
        $this->code_product = null;
        $this->price = null;
    }

    public function render()
    {
        return view('livewire.product.update');
    }
}
