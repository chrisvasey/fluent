<?php

namespace App\Http\Livewire\Fluent;

use Livewire\Component;

class FluentToolbar extends Component
{
    public $enabled = true;
    public $languages;
    public $currentLanguage;

    protected $listeners = ['changeLanguage' => 'handleLanguageChange'];

    public function handleLanguageChange(String $languageKey)
    {
        $this->currentLanguage = $languageKey;
    }

    public function mount()
    {
        $this->currentLanguage = config('fluent.default');

        $this->languages = collect(config('fluent.supported'));
    }

    public function render()
    {
        return view('livewire.fluent.fluent-toolbar');
    }
}
