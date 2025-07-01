<div class="p-4 bg-white border border-gray-200 rounded-xl shadow-sm space-y-4">
    <div class="text-base font-semibold text-gray-800">{{ $product->name }}</div>

    {{-- Attributes --}}
    @foreach ($productAttributesByGroup as $group => $items)
        <div class="space-y-1">
            <div class="text-gray-600 text-sm font-medium">{{ $group }}</div>

            <div class="flex flex-wrap gap-2">
                @foreach ($items as $item)
                    <label
                        class="flex items-center gap-1 px-2 py-1 bg-gray-50 rounded-md border border-gray-300 hover:bg-gray-100 cursor-pointer text-sm">
                        <input
                            type="radio"
                            name="{{ $group.''.$product->name }}"
                            wire:model.live="selectedAttributes.{{ $group }}"
                            value="{{ $item['id'] }}"
                            class="form-radio text-blue-600 w-4 h-4"
                        >
                        <span class="text-gray-700">
                            {{ $item['value'] }}
                            @if($item['price'] > 0)
                                <span class="text-xs text-green-600 font-semibold">(+{{ $item['price'] }} KD)</span>
                            @endif
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Sub Total Price --}}
    <div class="text-right text-green-600 font-bold text-base border-t pt-2">
        Sub Total: {{ $finalPrice }} KD
    </div>
</div>
