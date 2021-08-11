<div>
    <style>
        .qty{
            width: 20%;
            display: inline;
        }
    </style>
    <div class="card-body">
        <div class="form-group row pb-5">
            <form class="row g-3 mt-3" wire:submit.prevent="submit">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Product</label>
                <div class="col-sm-8">
                    <select class="form-control" wire:model="product_id" required>
                            <option>-- Pilih Product --</option>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}"> {{ $product->name_product }} </option>
                        @endforeach
                    </select>
                    @error('product_id')
                        <span class="error">{{ $message }}</span>
                    @enderror
                </div>
                <div class="col-sm-2">
                    <button type="submit" class="btn btn-success w-100">Submit</button>
                </div>
            </form>
        </div>

        @if (session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif

        <div class="card-body border-top pb-5 p-0 mt-3">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Nama</th>
                        <th scope="col">qty</th>
                        <th scope="col">Harga/Qty</th>
                        <th scope="col" style="width: 200px;">Total</th>
                        <th scope="col" style="width: 10px;"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($transactions as $transaction)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td> {{ $transaction->product->name_product }} </td>
                        <td>
                            <div wire:ignore>
                                @if ($transaction->qty>1)
                                    <span class="btn btn-danger btn-sm">-</span>    
                                @endif
                                <input type="text" class="form-control qty" value="{{ $transaction->qty }}" readonly>
                                <span class="btn btn-success btn-sm" >+</span>
                            </div>
                        </td>
                        <td>Rp. {{ number_format($transaction->product->price) }}  </td>
                        <td>Rp. {{ number_format($transaction->product->price*$transaction->qty) }} </td>
                        <td>
                            <button type="button" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right;">Total Pembelian</td>
                    <td>
                        Rp 
                    </td>
                    <tr>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="text-align:right;">Pembayaran</td>
                        <td style="text-align:right;">
                            <input type="number" wire:model="pembayaran" class="form-control">
                        </td>
                    </tr>
                    <tr>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="border:none;"></td>
                        <td style="text-align:right;">Kembalian</td>
                        <td style="text-align:left;">
                            Rp  
                        </td>
                    </tr>
                </tfoot>
            </table>
            <div class="">
                <button type="button" wire:click="save" class="btn btn-success btn-sm float-right">Submit</button>
            </div>
        </div>
    </div>
</div>

@push('script')
    
@endpush