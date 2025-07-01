<div class="mt-6 p-4 bg-gray-100 rounded">
    <h2 class="text-xl font-bold mb-2">Price Breakdown</h2>

    <p>Base Price: <strong>{{ $result['base_price'] }} KD</strong></p>
    <p>Attributes Total: <strong>{{ $result['attribute_price'] }} KD</strong></p>

    @if(count($result['discounts']))
        <p class="mt-2 font-semibold">Discounts:</p>
        <ul class="ml-4 list-disc">
            @foreach ($result['discounts'] as $discount)
                <li>{{ $discount['label'] }} (-{{ number_format($discount['amount'], 2) }} KD)</li>
            @endforeach
        </ul>
    @endif

    <p class="mt-4 text-lg font-bold">Final Price: {{ number_format($result['final'], 2) }} KD</p>
</div>
