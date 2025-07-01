<div class="grid grid-cols-1 md:grid-cols-3 gap-6">
    {{-- Left: Product Configurator (2/3 width) --}}
    <div class="md:col-span-2 space-y-6">
        {{-- Your existing product selection UI goes here --}}
        @livewire('product-selector')
        @livewire('user-type-toggle')
        @foreach ($selectedProducts as $product)
            @livewire('product-box', ['product' => $product], key($product->id))
        @endforeach
        @livewire('final-price-summary', ['products' => $selectedProducts])
    </div>

    {{-- Right: Explanation Box --}}
    <div class="space-y-4">
        @livewire('calculation-breakdown', ['products' => $selectedProducts])
    </div>
</div>
