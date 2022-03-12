@if($edit)
    <livewire:shrine.edit-loader>
        @livewire("shrine.pages.${slug}", [
            'slug' => $slug
        ])
    </livewire:shrine.edit-loader>
@else
    @livewire("shrine.pages.${slug}", [
        'slug' => $slug
    ])
@endif

