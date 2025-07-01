<div class="mt-6">
    <h2 class="text-xl font-bold mb-2">Configure Attributes</h2>

    @foreach ($attributes as $group => $groupAttributes)
        <div class="mb-4">
            <h3 class="font-semibold">{{ $group }}</h3>
            @foreach ($groupAttributes as $attribute)
                <label class="block">
                    <input
                        type="radio"
                        name="attribute_group_{{ $group }}"
                        value="{{ $attribute->id }}"
                        wire:model.live="selectedAttributes.{{ $group }}"
                        class="mr-1"
                    >
                    {{ $attribute->value }} (+{{ $attribute->price }} KD)
                </label>
            @endforeach
        </div>
    @endforeach
</div>
