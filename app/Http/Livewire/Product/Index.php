<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $paginate = 10;

    public $searchProduct;
    protected $queryString = ['searchProduct'];

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
    }

    public function render()
    {
        return view('livewire.product.index',[
            'products' => $this->paginate == null ? 
            Product::where('name_product','like', '%'.$this->searchProduct.'%')
            ->orWhere('code_product','like', '%'.$this->searchProduct.'%')
            ->orderBy('created_at','desc')->paginate($this->paginate) : 
            Product::where('name_product','like', '%'.$this->searchProduct.'%')
            ->orWhere('code_product','like', '%'.$this->searchProduct.'%')
            ->orderBy('created_at','desc')->paginate($this->paginate)
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
