<?php

namespace App\Http\Livewire\Product;

use Livewire\Component;
use App\Models\Product;

class Create extends Component
{
    public $name_product;
    public $code_product;
    public $price;

    protected $rules = [
        'name_product' => 'required|min:6',
        'code_product' => 'required',
        'price' => 'required',
    ];

    public function submit(){
        $this->validate();
        $product = Product::create([
            'name_product' => $this->name_product,
            'code_product' => $this->code_product,
            'price' => $this->price,
        ]);

        $this->deleteInput();

        session()->flash('message', 'Product berhasil Ditambahkan');
    }

    public function deleteInput(){
        $this->name_product = null;
        $this->code_product = null;
        $this->price = null;
    }

    public function render()
    {
        return view('livewire.product.create');
    }
}
