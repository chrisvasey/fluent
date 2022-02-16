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

    protected $listeners = [
        'changeEditMode',
        'componentSaved' => '$refresh'
    ];

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
        $this->editMode = !$this->editMode;
    }

    public function ensureLangLoader($files)
    {
        collect(config('fluent.supported'))->each(function($label, $locale) use ($files) {
            if(!in_array($locale.'/fluent.php', $files->toArray())){
                dd($locale);
                // Write file
            }
        });
    }

    /*
        Read JSON files from the lang disk.
        Grab the values needed for this component across all languages.
    */
    public function getJsonValuesFromFiles()
    {
        // Get all language JSON files and loaders from our Lang disk
        $langFiles = collect(Storage::disk('lang')->allFiles("/"));

        // Get loader files
        $loaders = $langFiles->filter(function ($value) {
            return Str::contains($value, 'fluent.php');
        })->flatten();

        // Create any loaders that don't exist
        $this->ensureLangLoader($loaders);

        // Get language JSON files
        $files = $langFiles->filter(function ($value) {
            return Str::contains($value, $this->path);
        })->flatten()->toArray();

        /*
            Format Array to be Values[path].
            Trim .json from the end of path to limit issues with dot notation.
        */
        $output = collect([]);
        foreach ($files as $file) {
            $data = json_decode(Storage::disk('lang')->get($file, true));
            $output[Str::beforeLast($file, '.json')] = $data->{$this->ref};
        }

        return $output->toArray();
    }

    // Go through supported languages and add any JSON values we have
    public function getSupportedLanguageValues()
    {
        $jsonValues = $this->getJsonValuesFromFiles();

        return collect(config('fluent.supported'))->map(function ($label, $locale) use($jsonValues) {
            $path = $locale."/".config('fluent.path')."/".$this->path;
            $value = key_exists($path, $jsonValues) ? $jsonValues[$path] : null;

            return (object)[
                'label' => $label,
                'path' => $path,
                'value' => $value,
                'old_value' => $value,
            ];
        });
    }

    // Handles click on component, used to launch edit model
    public function handleClick(){
        // If we aren't in edit mode, get the fuck out of here!
        if(!$this->editMode) return;

        // Open edit modal with this components values
        $this->emit('openModal', 'fluent.edit-modal', [
            'ref' => $this->ref,
            'default' => $this->default,
            'values' => $this->getSupportedLanguageValues(),
        ]);
    }

    public function render()
    {
        return view('livewire.fluent.h2');
    }
}
