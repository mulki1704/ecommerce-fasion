@extends('layouts.app')

@section('title', 'Pesanan Saya - TokoFashion')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Pesanan Saya</h1>

    @if($orders->isEmpty())
        <div class="text-center py-16">
            <svg class="w-16 h-16 text-gray-300 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
            </svg>
            <p class="mt-4 text-gray-500">Belum ada pesanan.</p>
            <a href="{{ route('products.index') }}" class="mt-4 inline-block bg-indigo-600 text-white px-6 py-2 rounded-lg font-medium hover:bg-indigo-700">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <a href="{{ route('orders.show', $order) }}" class="block bg-white rounded-xl p-6 border hover:shadow-md transition">
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-3">
                        <div>
                            <p class="font-semibold text-gray-900">{{ $order->order_number }}</p>
                            <p class="text-sm text-gray-500 mt-1">{{ $order->created_at->format('d M Y, H:i') }}</p>
                            <p class="text-sm text-gray-500">{{ $order->items->count() }} item</p>
                        </div>
                        <div class="text-right">
                            <p class="font-bold text-indigo-600">{{ $order->formattedTotal() }}</p>
                            <span class="inline-block mt-1 px-3 py-1 rounded-full text-xs font-medium
                                bg-{{ $order->statusColor() }}-100 text-{{ $order->statusColor() }}-800">
                                {{ $order->statusLabel() }}
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>
        <div class="mt-8">
            {{ $orders->links() }}
        </div>
    @endif
</div>

@endsection
