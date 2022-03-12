<main class="flex flex-row">
    <div class="flex-grow">
        @livewire("shrine.pages.${slug}", ['slug' => $slug])
    </div>
    @if($edit)
        <livewire:shrine.edit-loader/>
    @endif
</main>
