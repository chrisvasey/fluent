<x-app-layout>
    <x-slot name="header">
        <livewire:fluent
            type="h2"
            class="font-semibold text-xl text-gray-800 leading-tight"
            ref="title"
            default="Example"
        />
    </x-slot>

    <x-grapes-js/>
</x-app-layout>
