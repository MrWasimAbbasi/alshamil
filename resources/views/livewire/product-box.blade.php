<div class="p-4 border rounded shadow space-y-4">
    <div class="font-semibold text-lg">{{ $product->name }}</div>

    {{-- Attributes --}}
    @foreach ($productAttributesByGroup as $group => $items)
        <div class="mb-4">
            <div class="font-semibold mb-2 text-gray-700">{{ $group }}</div>

            <div class="flex flex-wrap gap-4">
                @foreach ($items as $item)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="{{$group.''.$product->name}}"
                            wire:model.live="selectedAttributes.{{ $group }}"
                            value="{{ $item['id'] }}"
                        >
                        <span>{{ $item['value'] }} @if($item['price'] > 0)
                                (+{{ $item['price'] }} KD)
                            @endif</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach

    {{-- Sub Total Price --}}
    <div class="text-right font-bold text-green-600 text-lg">
        Sub Total: {{ $finalPrice }} KD
    </div>
</div>
