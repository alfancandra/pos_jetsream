<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Index extends Component
{

    protected $listeners = ['storeProduct','newUpdateProduct'];
    public $updateProduct = false;

    public function getProduct($id){
        $this->updateProduct = true;
        $product = Product::find($id);
        $this->emit('updateProduct',$product);
    }

    public function deleteProduct($id)
    {
        $product = Product::find($id);
        $product->delete();
        session()->flash('message','Product Berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.product.index',[
            'products' => Product::orderBy('created_at','desc')->get()
        ]);
    }

    public function storeProduct($product){
        session()->flash('message', 'Product '. $product['name_product'].'  berhasil Ditambahkan');
    }

    public function newUpdateProduct($product)
    {
        session()->flash('message', 'Product '. $product['name_product'].'  berhasil di update');
        $this->updateProduct = false;
    }
}
