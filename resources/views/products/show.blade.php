@extends('layouts.app')

@section('title', $product->name . ' - TokoFashion')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">

    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('home') }}" class="hover:text-indigo-600">Beranda</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index') }}" class="hover:text-indigo-600">Produk</a>
        <span class="mx-2">/</span>
        <a href="{{ route('products.index', ['category' => $product->category->slug]) }}" class="hover:text-indigo-600">{{ $product->category->name }}</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $product->name }}</span>
    </nav>

    <div class="grid md:grid-cols-2 gap-10">
        <div class="aspect-square bg-gray-100 rounded-2xl overflow-hidden flex items-center justify-center">
            @if($product->image)
                <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
            @else
                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50">
                    <svg class="w-24 h-24 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                    </svg>
                </div>
            @endif
        </div>

        <div>
            <span class="text-sm font-medium text-indigo-600">{{ $product->category->name }}</span>
            <h1 class="mt-2 text-3xl font-bold text-gray-900">{{ $product->name }}</h1>

            <div class="mt-4 flex items-center gap-4">
                <span class="text-3xl font-bold text-indigo-600">{{ $product->formattedPrice() }}</span>
            </div>

            <div class="mt-6">
                @if($product->stock > 0)
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                        Stok: {{ $product->stock }}
                    </span>
                @else
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                        Habis
                    </span>
                @endif
            </div>

            @if($product->description)
                <div class="mt-6">
                    <h3 class="font-semibold text-gray-900 mb-2">Deskripsi</h3>
                    <p class="text-gray-600 leading-relaxed">{{ $product->description }}</p>
                </div>
            @endif

            @auth
                @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-8">
                        @csrf
                        <button type="submit" class="w-full bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-indigo-700 transition flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
                            </svg>
                            Tambah ke Keranjang
                        </button>
                    </form>
                @else
                    <div class="mt-8">
                        <button disabled class="w-full bg-gray-300 text-gray-500 font-semibold py-3 px-6 rounded-lg cursor-not-allowed">
                            Stok Habis
                        </button>
                    </div>
                @endif
            @else
                <div class="mt-8">
                    <a href="{{ route('login') }}" class="block w-full text-center bg-indigo-600 text-white font-semibold py-3 px-6 rounded-lg hover:bg-indigo-700 transition">
                        Masuk untuk Membeli
                    </a>
                </div>
            @endauth
        </div>
    </div>

    @if($relatedProducts->isNotEmpty())
        <section class="mt-16">
            <h2 class="text-xl font-bold text-gray-900 mb-6">Produk Lainnya</h2>
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                @foreach($relatedProducts as $product)
                    @include('partials._product_card', ['product' => $product])
                @endforeach
            </div>
        </section>
    @endif
</div>

@endsection
