<a href="{{ route('products.show', $product) }}" class="bg-white rounded-xl overflow-hidden hover:shadow-md transition border group">
    <div class="aspect-square bg-gray-100 flex items-center justify-center overflow-hidden">
        @if($product->image)
            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
        @else
            <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-indigo-50 to-purple-50">
                <svg class="w-12 h-12 text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        @endif
    </div>
    <div class="p-4">
        <p class="text-xs text-indigo-600 font-medium">{{ $product->category->name }}</p>
        <h3 class="mt-1 font-semibold text-gray-900 text-sm leading-tight line-clamp-2">{{ $product->name }}</h3>
        <p class="mt-2 font-bold text-indigo-600">{{ $product->formattedPrice() }}</p>
    </div>
</a>
