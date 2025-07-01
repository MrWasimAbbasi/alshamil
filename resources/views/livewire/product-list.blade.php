<div class="space-y-4">
    @foreach ($productIds as $productId)
        <livewire:product-box :product-id="$productId" :key="$productId"/>
    @endforeach
</div>
