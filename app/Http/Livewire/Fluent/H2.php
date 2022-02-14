<?php

namespace App\Http\Livewire\Fluent;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class H2 extends Component
{
    public $ref;
    public $default;
    public $class;
    public $output;
    public $path;
    public $editMode;

    protected $listeners = ['changeEditMode'];

    public function mount()
    {
        // Check if we are in edit mode
        $this->editMode = session('fluentEditMode');
        $this->ifEditModeFetchValues();
    }

    // If edit mode, get field values
    public function ifEditModeFetchValues()
    {
        if(!$this->editMode) return;

        $this->values = $this->getSupportedLanguageValues();
    }

    public function changeEditMode()
    {
        // Toggle edit mode
        $this->editMode = !$this->editMode;
        $this->ifEditModeFetchValues();
    }

    public function getJsonValuesFromFiles()
    {
        // Set the path to default lang file for this route
        $files = collect(Storage::disk('lang')->allFiles("/"))->filter(function ($value) {
            return Str::contains($value, $this->path);
        })->flatten()->toArray();


        // Format Array to be Values[path]
        $output = collect([]);
        foreach ($files as $file) {
            $data = json_decode(Storage::disk('lang')->get($file, true));
            $output[$file] = $data->{$this->ref};
        }

        return $output->toArray();
    }

    public function getSupportedLanguageValues()
    {
        // $this->ref = request()->route()->getName();

        // Get JSON values and removed any unsupported languages
        $values = collect($this->getJsonValuesFromFiles())->filter(function($item, $key){
            return Arr::exists(config('fluent.supported'), Str::before($key, '/'));
        });

        return $values;
    }

    public function handleClick(){
        // If we aren't in edit mode, get the fuck out of here!
        if(!$this->editMode) return;

        // Open edit modal with this components values
        $this->emit('openModal', 'fluent.edit-modal', [
            'ref' => $this->ref,
            'path' => $this->path,
            'default' => $this->default,
            'values' => $this->retreiveStoredValue(),
        ]);
    }

    public function render()
    {
        return view('livewire.fluent.h2');
    }
}
