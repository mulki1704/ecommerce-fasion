@extends('layouts.app')

@section('title', 'Beranda - TokoFashion')

@section('content')

<section class="bg-gradient-to-r from-indigo-600 to-purple-600 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-20">
        <div class="max-w-2xl">
            <h1 class="text-4xl md:text-5xl font-bold leading-tight">Tampil Stylish Setiap Hari</h1>
            <p class="mt-4 text-lg text-indigo-100">Temukan koleksi fashion terbaru dengan harga terjangkau. Kualitas premium, gaya kekinian.</p>
            <a href="{{ route('products.index') }}" class="mt-8 inline-block bg-white text-indigo-600 font-semibold px-8 py-3 rounded-lg hover:bg-indigo-50 transition">
                Belanja Sekarang
            </a>
        </div>
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <h2 class="text-2xl font-bold text-gray-900 mb-6">Kategori</h2>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @foreach($categories as $category)
            <a href="{{ route('products.index', ['category' => $category->slug]) }}" class="bg-white rounded-xl p-6 text-center hover:shadow-md transition border">
                <div class="w-12 h-12 bg-indigo-100 rounded-full flex items-center justify-center mx-auto mb-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/>
                    </svg>
                </div>
                <h3 class="font-semibold text-gray-900">{{ $category->name }}</h3>
                <p class="text-sm text-gray-500 mt-1">{{ $category->products_count }} produk</p>
            </a>
        @endforeach
    </div>
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Produk Unggulan</h2>
        <a href="{{ route('products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat Semua &rarr;</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($featuredProducts as $product)
            @include('partials._product_card', ['product' => $product])
        @endforeach
    </div>
    @if($featuredProducts->isEmpty())
        <p class="text-center text-gray-500 py-12">Belum ada produk unggulan.</p>
    @endif
</section>

<section class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-2xl font-bold text-gray-900">Produk Terbaru</h2>
        <a href="{{ route('products.index') }}" class="text-sm font-medium text-indigo-600 hover:text-indigo-700">Lihat Semua &rarr;</a>
    </div>
    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
        @foreach($latestProducts as $product)
            @include('partials._product_card', ['product' => $product])
        @endforeach
    </div>
    @if($latestProducts->isEmpty())
        <p class="text-center text-gray-500 py-12">Belum ada produk.</p>
    @endif
</section>

@endsection
