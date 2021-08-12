<?php

namespace App\Http\Livewire\Kasir;

use Livewire\Component;
use App\Models\Product;
use App\Models\Transaction;

class Index extends Component
{

    public $product_id;
    public $pembayaran;

    protected $rules = [
        'product_id' => 'required|unique:transactions'
    ];

    public function submit()
    {
        $this->validate();

        $transaction = new Transaction();
        $transaction->product_id = $this->product_id;
        $transaction->qty = 1;
        $transaction->total = $transaction->product->price;
        $transaction->save();

        session()->flash('message','Produk Berhasil ditambahkan');
    }

    public function increment($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'qty' => $transaction->qty+1,
            'total' => $transaction->total*($transaction->qty+1)
        ]);

        session()->flash('message','Qty ditambah');

        return redirect()->to('/kasir');
    }

    public function decrement($id)
    {
        $transaction = Transaction::find($id);
        $transaction->update([
            'qty' => $transaction->qty-1,
            'total' => $transaction->total-($transaction->product->price)
        ]);

        session()->flash('message','Qty dikurang');

        return redirect()->to('/kasir');
    }

    public function deleteOne($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        session()->flash('message','Product berhasil dihapus');
    }

    public function render()
    {
        return view('livewire.kasir.index',[
            'products' => Product::orderBy('name_product','asc')->get(),
            'transactions' => Transaction::get()
        ]);
    }
}
