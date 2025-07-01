<div class="p-4 border rounded">
    <h2 class="text-lg font-bold mb-2">Select Products</h2>

    @foreach ($products as $product)
        <label class="block">
            <input type="checkbox" wire:model.live="selected" value="{{ $product->id }}" class="mr-2">
            {{ $product->name }} ({{ $product->base_price }} KD)
        </label>
    @endforeach
</div>
