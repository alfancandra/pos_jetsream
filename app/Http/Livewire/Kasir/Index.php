<?php

namespace App\Http\Livewire\Kasir;

use Livewire\Component;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\Order;
use App\Models\OrderProduct;

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

    public function save()
    {
        $order = Order::create([
            'no_order' => 'OD-'.date('Ymd').rand(1111,9999),
            'nama_kasir' => auth()->user()->name
        ]);

        $transaction = Transaction::get();
        foreach ($transaction as $key=>$value){
            $product = array(
                'order_id' => $order->id,
                'product_id' => $value->id,
                'qty' => $value->qty,
                'total' => $value->total,
                'created_at' => \Carbon\carbon::now(),
                'updated_at' => \Carbon\carbon::now()
            );

            $orderProduct = OrderProduct::insert($product);
            
            $deleteTransaction = Transaction::where('id',$value->id)->delete();
        }

        session()->flash('message','Transaksi Berhasil');
    }
}
