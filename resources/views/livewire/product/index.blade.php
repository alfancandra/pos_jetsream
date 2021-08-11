<div>
    <div class="container">

      <div class="card-body pb-5">

        @if($updateProduct)
        <h1 class="h3 pb-2 mb-5 border-bottom">Form Update Product</h1>
          @if(session()->has('message'))
            <script>
              Swal.fire(
                '{{ session('message') }}'
              )
            </script>
          @endif
          @livewire('product.update')
        @else
        <h1 class="h3 pb-2 mb-5 border-bottom">Form Create Product</h1>
          @if(session()->has('message'))
            <script>
              Swal.fire(
                '{{ session('message') }}'
              )
            </script>
          @endif
          @livewire('product.create')
        @endif
      </div>

      <hr class="mt-3">
      
      <div class="card-body pb-5">
        <nav class="navbar navbar-light bg-light">
          <div class="container-fluid">
            <div class="navbar-brand">
              <select class="form-select" wire:model="paginate">
                <option value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
              </select>
            </div>
            <div class="d-flex">
              <input type="search" wire:model="searchProduct" class="form-control" name="" placeholder="Search" aria-label="search">
            </div>
          </div>
        </nav>

        <table class="table table-striped table-hover">
          <thead class="table-light">
            <tr>
              <th scope="col">No</th>
              <th scope="col">Nama</th>
              <th scope="col">Kode</th>
              <th scope="col">Harga</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($products as $product)
              <tr>
                <td scope="row">{{ $loop->iteration }}</td>
                <td>{{ $product->name_product }}</td>
                <td>{{ $product->code_product }}</td>
                <td>Rp. {{ number_format($product->price) }}</td>
                <td>
                  <button wire:click="getProduct({{$product->id}})" class="btn btn-primary btn-sm">Edit</button>
                  <button wire:click="$emit('deleteProduct',{{$product->id}})" class="btn btn-danger btn-sm">Hapus</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
        {{ $products->links() }}
      </div>
    </div>
</div>

@push('script')
<script>
  document.addEventListener('livewire:load',function(){
    @this.on('deleteProduct',idProduct => {
      Swal.fire({
      title: 'Are you sure?',
      text: "You won't be able to revert this!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonText: 'Yes, delete it!',
      cancelButtonText: 'No, cancel!',
      reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
          @this.call('deleteProduct',idProduct)
          Swal.fire(
            'Deleted!',
            'Your file has been deleted.',
            'success'
          )
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
          ) {
            Swal.fire(
              'Cancelled',
              'Your imaginary file is safe :)',
              'error'
          )
        }
      })
    })
  })
</script>
@endpush