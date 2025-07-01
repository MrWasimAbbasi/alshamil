<div>
    <h2 class="text-xl font-bold mb-2">Select Products</h2>
    @foreach ($products as $product)
        <label class="block mb-1">
            <input type="checkbox" wire:model.live="selected" value="{{ $product->id }}" class="mr-1">
            {{ $product->name }} ({{ $product->base_price }} KD)
        </label>
    @endforeach

</div>
