<div class="grid grid-cols-2 gap-10 py-12">
    <div class="space-y-4" x-data="{ image: '{{ $this->getProduct->image->path }}' }">
        <div class="bg-white p-5 rounded-lg shadow">
            <img x-bind:src="image" alt="">
        </div>

        <div class="grid grid-cols-4 gap-4">
            @foreach($this->getProduct->images as $image)
                <div class="rounded bg-white p-2 shadow cursor-pointer">
                    <img src="{{ $image->path }}" @click="image = '{{ $image->path }}' " alt="">
                </div>
            @endforeach
        </div>
    </div>

    <div>
        <h1 class="text-3xl font-medium">{{ $this->getProduct->name }}</h1>
        <div class="text-xl text-gray-700">
            {{ $this->getProduct->price }}
        </div>

        <div class="mt-4">
            {{ $this->getProduct->description }}
        </div>

        <div class="mt-4 space-y-4">
            <select wire:model="variant" class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-800">
                <option selected>Select Variant</option>
                @foreach($this->getProduct->variants as $variant)
                    <option value="{{ $variant->id }}">{{ $variant->size }} / {{ ucfirst($variant->color) }}</option>
                @endforeach
            </select>

            @error('variant')
                <div class="mt-2 text-red-600">{{ $message }}</div>
            @enderror

            <x-button wire:click="addToCart">Add to Cart</x-button>
        </div>
    </div>
</div>
