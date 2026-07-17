@extends('layouts.app')

@section('title', 'Pesanan ' . $order->order_number . ' - TokoFashion')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <nav class="text-sm text-gray-500 mb-6">
        <a href="{{ route('orders.index') }}" class="hover:text-indigo-600">Pesanan Saya</a>
        <span class="mx-2">/</span>
        <span class="text-gray-900">{{ $order->order_number }}</span>
    </nav>

    <div class="grid lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl p-6 border">
                <div class="flex items-center justify-between mb-4">
                    <h1 class="text-xl font-bold text-gray-900">{{ $order->order_number }}</h1>
                    <span class="px-3 py-1 rounded-full text-sm font-medium
                        bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800">
                        {{ $order->statusLabel() }}
                    </span>
                </div>
                <p class="text-sm text-gray-500">Dipesan pada {{ $order->created_at->format('d M Y, H:i') }}</p>
            </div>

            <div class="bg-white rounded-xl p-6 border">
                <h2 class="font-bold text-gray-900 mb-4">Item Pesanan</h2>
                <div class="space-y-4">
                    @foreach($order->items as $item)
                        <div class="flex items-center gap-4">
                            <div class="w-16 h-16 bg-gray-100 rounded-lg flex-shrink-0 flex items-center justify-center overflow-hidden">
                                @if($item->product?->image)
                                    <img src="{{ $item->product->image }}" alt="{{ $item->product_name }}" class="w-full h-full object-cover">
                                @else
                                    <svg class="w-6 h-6 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                                    </svg>
                                @endif
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-900">{{ $item->product_name }}</p>
                                <p class="text-sm text-gray-500">{{ $item->formattedSubtotal() }} ({{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }})</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl p-6 border sticky top-24 space-y-4">
                <h2 class="font-bold text-gray-900">Ringkasan</h2>
                <div class="space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-gray-500">Subtotal</span>
                        <span>{{ $order->formattedTotal() }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-500">Ongkir</span>
                        <span class="text-green-600">Gratis</span>
                    </div>
                    <hr>
                    <div class="flex justify-between font-bold text-base">
                        <span>Total</span>
                        <span class="text-indigo-600">{{ $order->formattedTotal() }}</span>
                    </div>
                </div>

                <hr>

                <div class="space-y-2 text-sm">
                    <div>
                        <p class="text-gray-500">Pembayaran</p>
                        <p class="font-medium">{{ $order->payment_method === 'bank_transfer' ? 'Transfer Bank' : 'Bayar di Tempat' }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Alamat</p>
                        <p class="font-medium">{{ $order->address }}</p>
                    </div>
                    <div>
                        <p class="text-gray-500">Telepon</p>
                        <p class="font-medium">{{ $order->phone }}</p>
                    </div>
                    @if($order->notes)
                        <div>
                            <p class="text-gray-500">Catatan</p>
                            <p class="font-medium">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
