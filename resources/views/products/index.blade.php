@extends('layout.app')

@section('content')
    <h2>Daftar Produk</h2>
    <form action="{{ route('products.search') }}" method="GET">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="Cari produk..." name="query" value="{{ request('query') }}">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="submit">Cari</button>
                <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">Clear</a>
            </div>
        </div>
    </form>
    <div class="d-flex justify-content-end mb-3">
        <div>
            <a href="{{ route('products.index', ['sort' => 'asc', 'order' => 'name']) }}" class="btn btn-outline-secondary">Nama <i class="fas fa-arrow-up"></i></a>
            <a href="{{ route('products.index', ['sort' => 'desc', 'order' => 'name']) }}" class="btn btn-outline-secondary">Nama <i class="fas fa-arrow-down"></i></a>
            <a href="{{ route('products.index', ['sort' => 'asc', 'order' => 'price']) }}" class="btn btn-outline-secondary">Harga <i class="fas fa-arrow-up"></i></a>
            <a href="{{ route('products.index', ['sort' => 'desc', 'order' => 'price']) }}" class="btn btn-outline-secondary">Harga <i class="fas fa-arrow-down"></i></a>
            <a href="{{ route('products.index', ['sort' => 'asc', 'order' => 'stock']) }}" class="btn btn-outline-secondary">Stok <i class="fas fa-arrow-up"></i></a>
            <a href="{{ route('products.index', ['sort' => 'desc', 'order' => 'stock']) }}" class="btn btn-outline-secondary">Stok <i class="fas fa-arrow-down"></i></a>
        </div>
    </div>
    <div class="row">
        @foreach ($products as $product)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ $product->image }}" class="card-img-top" alt="{{ $product->name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">Harga: {{ $product->price }}</p>
                        <p class="card-text">Stok: {{ $product->stock }}</p>
                        <a href="{{ route('products.show', $product->id) }}" class="btn btn-info">Detail</a>
                        <a href="{{ route('products.edit', $product->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    <!-- Tampilkan navigasi pagination -->
    {{ $products->links() }}
    <a href="{{ route('products.create') }}" class="btn btn-success">Tambah Produk Baru</a>
@endsection
