@extends('layouts.app')

@section('title', 'Checkout - TokoFashion')

@section('content')

<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <h1 class="text-2xl font-bold text-gray-900 mb-6">Checkout</h1>

    <form action="{{ route('orders.place') }}" method="POST" class="grid lg:grid-cols-3 gap-8">
        @csrf

        <div class="lg:col-span-2 space-y-6">
            <div class="bg-white rounded-xl p-6 border">
                <h2 class="font-bold text-gray-900 mb-4">Detail Pengiriman</h2>

                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat Pengiriman *</label>
                        <textarea name="address" rows="3" required
                                  class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Jalan, No Rumah, RT/RW, Kelurahan, Kecamatan, Kota">{{ old('address') }}</textarea>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon *</label>
                        <input type="text" name="phone" value="{{ old('phone') }}" required
                               class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                               placeholder="08xxxxxxxxxx">
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Catatan (opsional)</label>
                        <textarea name="notes" rows="2"
                                  class="w-full border rounded-lg px-4 py-2 text-sm focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500"
                                  placeholder="Catatan untuk penjual...">{{ old('notes') }}</textarea>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-xl p-6 border">
                <h2 class="font-bold text-gray-900 mb-4">Metode Pembayaran</h2>
                <div class="space-y-3">
                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 {{ old('payment_method') == 'bank_transfer' ? 'border-indigo-500 bg-indigo-50' : '' }}">
                        <input type="radio" name="payment_method" value="bank_transfer" {{ old('payment_method', 'bank_transfer') == 'bank_transfer' ? 'checked' : '' }} class="text-indigo-600">
                        <div>
                            <p class="font-medium text-gray-900">Transfer Bank</p>
                            <p class="text-sm text-gray-500">BCA, Mandiri, BRI, BNI</p>
                        </div>
                    </label>
                    <label class="flex items-center gap-3 p-3 border rounded-lg cursor-pointer hover:bg-gray-50 {{ old('payment_method') == 'cod' ? 'border-indigo-500 bg-indigo-50' : '' }}">
                        <input type="radio" name="payment_method" value="cod" {{ old('payment_method') == 'cod' ? 'checked' : '' }} class="text-indigo-600">
                        <div>
                            <p class="font-medium text-gray-900">Bayar di Tempat (COD)</p>
                            <p class="text-sm text-gray-500">Bayar saat barang diterima</p>
                        </div>
                    </label>
                </div>
                @error('payment_method')
                    <p class="text-red-500 text-xs mt-2">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl p-6 border sticky top-24">
                <h2 class="font-bold text-gray-900 mb-4">Ringkasan Pesanan</h2>
                <div class="space-y-3 mb-4">
                    @foreach($cartItems as $item)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-600">{{ $item->product->name }} x{{ $item->quantity }}</span>
                            <span class="font-medium">{{ $item->formattedSubtotal() }}</span>
                        </div>
                    @endforeach
                </div>
                <hr class="my-4">
                <div class="flex justify-between text-base font-bold">
                    <span>Total</span>
                    <span class="text-indigo-600">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
                <button type="submit" class="mt-6 w-full bg-indigo-600 text-white font-semibold py-3 rounded-lg hover:bg-indigo-700 transition">
                    Buat Pesanan
                </button>
            </div>
        </div>
    </form>
</div>

@endsection
