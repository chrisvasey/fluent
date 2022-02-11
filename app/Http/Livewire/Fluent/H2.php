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
    public $editMode = true;

    protected $listeners = ['changeEditMode'];

    public function mount()
    {
        $this->retreiveStoredValue();
    }

    public function changeEditMode()
    {
        $this->editMode = !$this->editMode;
    }

    public function retreiveStoredValue()
    {
        // Attempt to retrieve a stored value for this ref
        $storedValue = json_decode(Storage::disk('local')->get(config('fluent.path')."/{$this->path}.json"), true);

        // If we have no file at all, create one with this ref and value
        if(!$storedValue){
            $storedValue = [
                config('fluent.default') => [$this->ref => $this->default]
            ];

            Storage::disk('local')->put(config('fluent.path')."/{$this->path}.json", json_encode($storedValue));
        }

        //TODO: Here it should be checking for the current language rather than the default
        $this->output = $storedValue[config('fluent.default')][$this->ref] ?? $this->default;

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
