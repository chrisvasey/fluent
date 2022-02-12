<?php

namespace App\Http\Livewire\Fluent;

use Livewire\Component;

class FluentToolbar extends Component
{
    public $enabled = true;
    public $editMode;
    public $languages;
    public $currentLanguage;

    protected $listeners = [
        'changeEditMode',
        'changeLanguage' => 'handleLanguageChange'
    ];

    public function handleLanguageChange($languageKey)
    {
        $this->currentLanguage = $languageKey;
    }

    public function changeEditMode()
    {
        session(['fluentEditMode' => $this->editMode]);
    }

    public function mount()
    {
        $this->editMode = session('fluentEditMode');
        $this->currentLanguage = config('fluent.default');

        $this->languages = collect(config('fluent.supported'));
    }

    public function render()
    {
        return view('livewire.fluent.fluent-toolbar');
    }
}
