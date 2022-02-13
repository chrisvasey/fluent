<?php

namespace App\Http\Livewire\Fluent;

use Livewire\Component;
use Illuminate\Support\Facades\App;

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
        App::setLocale($languageKey);
        $this->currentLanguage = $languageKey;
    }

    public function changeEditMode()
    {
        session(['fluentEditMode' => $this->editMode]);
    }

    public function mount()
    {
        $this->editMode = session('fluentEditMode');
        $this->currentLanguage = App::currentLocale();

        $this->languages = collect(config('fluent.supported'));
    }

    public function render()
    {
        return view('livewire.fluent.fluent-toolbar');
    }
}
