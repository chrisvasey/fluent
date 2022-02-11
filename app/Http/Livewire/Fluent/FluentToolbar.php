<?php

namespace App\Http\Livewire\Fluent;

use Livewire\Component;

class FluentToolbar extends Component
{
    public $enabled = true;
    public $languages;
    public $currentLanguage;

    public function mount()
    {
        $supported = config('fluent.supported');

        $this->currentLanguage = config('fluent.default');

        $this->languages = collect($supported)->map(function ($item, $key){
            return [
                'ref' => $key,
                'label' => $item,
                'active' => ($key === $this->currentLanguage),
            ];
        });
    }

    public function render()
    {
        return view('livewire.fluent.fluent-toolbar');
    }
}
