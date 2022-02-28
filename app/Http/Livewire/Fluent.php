<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;


class Fluent extends Component
{
    public $ref;
    public $default;
    public $type;
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

        $this->checkSupportedHtmlTag();
    }

    public function checkSupportedHtmlTag()
    {
        if(in_array(strtolower($this->type), config('fluent.supported_tags'))){
            return $this->type = strtolower($this->type);
        }

        return $this->type = 'span';
    }

    // Toggle edit mode
    public function changeEditMode()
    {
        $this->editMode = !$this->editMode;
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
        return view('livewire.fluent');
    }
}
