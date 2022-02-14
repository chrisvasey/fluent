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
    public $langFileExt = ".json";

    protected $listeners = ['changeEditMode'];

    // Setup component
    public function mount($path)
    {
        // Get JSON path from props or route name
        $this->path = $path ?? request()->route()->getName();

        // Check if we are in edit mode
        $this->editMode = session('fluentEditMode');

        // If edit mode, get languages field values
        if($this->editMode){
            $this->values = $this->getSupportedLanguageValues();
        }
    }

    // Toggle edit mode
    public function changeEditMode()
    {
        // If edit mode, get languages field values
        if($this->editMode){
            $this->values = $this->getSupportedLanguageValues();
        }
    }

    /*
        Read JSON files from the lang disk.
        Grab the values needed for this component across all languages.
    */
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
            $output[Str::beforeLast($file, $this->langFileExt)] = $data->{$this->ref};
        }

        return $output->toArray();
    }

    // Get JSON values and removed any unsupported languages not listed in fluent.supported
    public function getSupportedLanguageValues()
    {
        $values = collect($this->getJsonValuesFromFiles())->filter(function($item, $key){
            return Arr::exists(config('fluent.supported'), Str::before($key, '/'));
        });

        return $values;
    }

    // Handles click on component, used to launch edit model
    public function handleClick(){
        // If we aren't in edit mode, get the fuck out of here!
        if(!$this->editMode) return;

        // Open edit modal with this components values
        $this->emit('openModal', 'fluent.edit-modal', [
            'ref' => $this->ref,
            'path' => $this->path,
            'default' => $this->default,
            'values' => $this->values,
        ]);
    }

    public function render()
    {
        return view('livewire.fluent.h2');
    }
}
