<div>
    @if(session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <form class="row g-3" wire:submit.prevent="submit">
      <div class="col-12">
        <label for="inputEmail4" class="form-label">Nama Produk</label>
        <input type="text" wire:model="name_product" class="form-control" id="inputEmail4" placeholder="Contoh : Baju Lengan panjang" required>
        @error('name_product') <span class="error">{{ $message }}</span> @enderror
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Kode Produk</label>
        <input type="text" wire:model="code_product" class="form-control" id="inputPassword4" placeholder="Contoh : BLP312">
        @error('code_product') <span class="error">{{ $message }}</span> @enderror
      </div>
      <div class="col-md-6">
        <label for="inputPassword4" class="form-label">Harga Produk</label>
        <input type="number" class="form-control" wire:model="price" id="inputPassword4" min="1" required>
        @error('price') <span class="error">{{ $message }}</span> @enderror
      </div>
      
      <div class="col-12 pt-2">
        <button type="submit" class="btn btn-primary w-100">Submit</button>
      </div>
    </form>
</div>
