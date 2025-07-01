<div class="space-y-6">
    <livewire:product-selector/>
    <livewire:attribute-selector :selected-products="$selectedProducts"/>
    <livewire:user-type-toggle/>
    <livewire:price-breakdown
        :selected-products="$selectedProducts"
        :selected-attributes="$selectedAttributes"
        :user-type="$userType"
    />
</div>
