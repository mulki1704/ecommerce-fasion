@extends('layouts.app')

@section('title', 'Produk - TokoFashion')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Semua Produk</h1>
            <p class="text-sm text-gray-500 mt-1">{{ $products->total() }} produk ditemukan</p>
        </div>

        <form method="GET" action="{{ route('products.index') }}" class="flex flex-col sm:flex-row gap-3">
            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari produk..."
                   class="px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
            <select name="category" class="px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>
                        {{ $category->name }} ({{ $category->products_count }})
                    </option>
                @endforeach
            </select>
            <select name="sort" class="px-4 py-2 border rounded-lg text-sm focus:ring-2 focus:ring-indigo-500">
                <option value="newest" {{ request('sort') == 'newest' ? 'selected' : '' }}>Terbaru</option>
                <option value="cheapest" {{ request('sort') == 'cheapest' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="expensive" {{ request('sort') == 'expensive' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
            <button type="submit" class="bg-indigo-600 text-white px-6 py-2 rounded-lg text-sm font-medium hover:bg-indigo-700">
                Cari
            </button>
        </form>
    </div>

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($products as $product)
            @include('partials._product_card', ['product' => $product])
        @endforeach
    </div>

    @if($products->isEmpty())
        <div class="text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
            </svg>
            <p class="mt-4 text-gray-500">Tidak ada produk ditemukan.</p>
        </div>
    @endif

    <div class="mt-8">
        {{ $products->links() }}
    </div>
</div>

@endsection
