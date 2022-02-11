@if($enabled)
    <div class="fixed bottom-0 w-full bg-red-400">
        <div class="flex w-100">
            <h1 class="font-semibold text-lg text-gray-800 leading-tight py-2 px-4">Fluent</h1>
            <div class="flex items-center p-2 px-4  border-x-2 border-red-500" x-data="{ on: false }">
                <span class="mr-2" id="annual-billing-label" @click="on = !on; $refs.switch.focus()">
                    <span class="text-sm font-medium text-gray-900">Edit Mode: </span>
                  </span>
                <button type="button" class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 bg-red-600" role="switch" aria-checked="true" x-ref="switch" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'bg-red-600': on, 'bg-gray-200': !(on) }" aria-labelledby="annual-billing-label" :aria-checked="on.toString()" @click="on = !on">
                  <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200 translate-x-5" x-state:on="Enabled" x-state:off="Not Enabled" :class="{ 'translate-x-5': on, 'translate-x-0': !(on) }"></span>
                </button>
            </div>
            <div class="flex items-center ml-2">
                <h1 class="text-sm font-medium text-gray-900">Current Language:</h1>
            </div>
            @foreach ($languages as $key => $language)
                <button
                    wire:click="$emit('changeLanguage', '{{ $key }}')"
                    type="button"
                    @class([
                        "inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium my-2 mx-2 bg-red-100 text-red-800",
                        "bg-red-800 text-red-100" => ($key == $currentLanguage)
                    ])
                >
                    {{ $language['label'] }}
                </button>
            @endforeach
        </div>
    </div>
@endif
{{-- If your happiness depends on money, you will never be happy with yourself. --}}
