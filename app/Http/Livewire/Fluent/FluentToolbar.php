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
        return redirect()->route('language', [
            'locale' => $languageKey
        ]);
    }

    public function changeEditMode()
    {
        $status = $this->editMode;
        session(['fluentEditMode' => $status]);
        ray($status);
    }

    public function mount()
    {
        // Check if we are in edit mode
        $this->editMode = session('fluentEditMode');

        $this->currentLanguage = App::currentLocale();

        $this->languages = collect(config('fluent.supported'));
    }

    public function render()
    {
        return view('livewire.fluent.fluent-toolbar');
    }
}
