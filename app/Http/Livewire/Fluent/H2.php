<?php

namespace App\Http\Livewire\Fluent;

use Livewire\Component;
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
        $this->retreiveStoredValue();
        $this->editMode = session('fluentEditMode');
    }

    public function changeEditMode()
    {
        $this->editMode = !$this->editMode;
    }

    public function retreiveStoredValue()
    {
        // Set the path to default lang file for this route
        $jsonPath = "/".config('app.fallback_locale')."/".config('fluent.path')."/".$this->path.".json";

        // Attempt to retrieve a stored value for this ref
        $storedValue = json_decode(Storage::disk('lang')->get($jsonPath, true));

        // If we have no file at all, create one with this ref and value
        if(!$storedValue){
            Storage::disk('lang')->put($jsonPath, json_encode([
                $this->ref => $this->default
            ]));
        }

        //TODO: Here it should be checking for the current language rather than the default
        $this->output = $storedValue->{config('fluent.default')}->{$this->ref} ?? $this->default;

        return $storedValue;
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
