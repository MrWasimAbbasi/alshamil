<div class="mt-6 bg-white border border-gray-200 rounded-xl p-4 shadow-sm">
    <h2 class="text-sm font-medium text-gray-500 uppercase tracking-wide mb-2">User Type</h2>

    <div class="flex gap-6">
        <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
            <input
                type="radio"
                wire:model.live="userType"
                name="userType"
                value="normal"
                class="form-radio text-blue-600"
            >
            Normal
        </label>

        <label class="inline-flex items-center gap-2 text-sm text-gray-700 cursor-pointer">
            <input
                type="radio"
                wire:model.live="userType"
                name="userType"
                value="company"
                class="form-radio text-blue-600"
            >
            Company
        </label>
    </div>
</div>
