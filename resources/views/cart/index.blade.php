@extends('layouts.app')

@section('title', 'Keranjang - TokoFashion')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Keranjang Belanja</h1>

    @if($cartItems->isEmpty())
        <div class="text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 100 4 2 2 0 000-4z"/>
            </svg>
            <p class="mt-4 text-gray-500">Keranjang belanja kosong.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="grid lg:grid-cols-3 gap-8">
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="bg-white rounded-xl p-4 sm:p-6 border flex flex-col sm:flex-row gap-4">
                        <div class="w-full sm:w-24 h-24 bg-gray-100 rounded-lg flex-shrink-0 flex items-center justify-center overflow-hidden">
                            @if($item->product->image)
                                <img src="{{ $item->product->image }}" alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                            @else
                                <svg class="w-8 h-8 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                </svg>
                            @endif
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between">
                                <div>
                                    <a href="{{ route('products.show', $item->product) }}" class="font-semibold text-gray-900 hover:text-indigo-600">{{ $item->product->name }}</a>
                                    <p class="text-sm text-gray-500">{{ $item->product->formattedPrice() }}</p>
                                </div>
                                <form action="{{ route('cart.remove', $item) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700 text-sm">Hapus</button>
                                </form>
                            </div>
                            <div class="mt-3 flex items-center gap-3">
                                <form action="{{ route('cart.update', $item) }}" method="POST" class="flex items-center gap-2">
                                    @csrf @method('PATCH')
                                    <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                           class="w-20 border rounded-lg px-3 py-1 text-sm text-center">
                                    <button type="submit" class="text-indigo-600 hover:text-indigo-700 text-sm font-medium">Update</button>
                                </form>
                                <span class="text-sm font-semibold text-gray-900 ml-auto">{{ $item->formattedSubtotal() }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl p-6 border sticky top-24">
                    <h2 class="font-bold text-gray-900 mb-4">Ringkasan</h2>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-gray-500">Subtotal ({{ $cartItems->sum('quantity') }} item)</span>
                            <span class="font-medium">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Ongkos Kirim</span>
                            <span class="font-medium text-green-600">Gratis</span>
                        </div>
                        <hr>
                        <div class="flex justify-between text-base font-bold">
                            <span>Total</span>
                            <span class="text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <a href="{{ route('orders.checkout') }}" class="mt-6 block w-full bg-indigo-600 text-white text-center font-semibold py-3 rounded-lg hover:bg-indigo-700 transition">
                        Checkout
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>

@endsection
