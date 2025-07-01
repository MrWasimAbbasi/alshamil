<div class="p-6 bg-white border border-gray-200 rounded-xl shadow-sm space-y-4">
    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">Select Products</h2>

    <div class="space-y-3">
        @foreach ($products as $product)
            <label
                class="flex items-center gap-3 p-3 border border-gray-200 rounded-lg bg-gray-50 hover:bg-gray-100 transition">
                <input
                    type="checkbox"
                    wire:model.live="selected"
                    value="{{ $product->id }}"
                    class="w-4 h-4 text-blue-600 border-gray-300 rounded"
                >
                <div class="text-sm text-gray-800">
                    {{ $product->name }}
                    <span class="text-xs text-gray-500">({{ $product->base_price }} KD)</span>
                </div>
            </label>
        @endforeach
    </div>
</div>
