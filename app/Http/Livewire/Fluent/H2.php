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
    public $edit;

    public function mount()
    {
        $this->output = $this->retreiveStoredValue();
        $this->checkIfEdit();

    }

    public function checkIfEdit()
    {
        // If we have ?fluent=true in the URL, enable edit.
        // TODO: Check for Admin/Auth to enable.
        if(request()->get('fluent')){
            $this->edit = true;
        }
    }

    public function retreiveStoredValue()
    {
        // Attempt to retrieve a stored value for this ref
        $storedValue = json_decode(Storage::disk('local')->get(config('fluent.path')."/{$this->path}.json"), true);

        // If we have no file at all, create one with this ref and value
        if(!$storedValue){
            Storage::disk('local')->put(config('fluent.path')."/{$this->path}.json", json_encode([
                config('fluent.default') => [$this->ref => $this->default]
            ]));
        }

        //TODO: Here it should be checking for the current language rather than the default
        return $storedValue[config('fluent.default')][$this->ref] ?? $this->default;
    }

    public function handleClick(){
        // If we aren't in edit mode, get the fuck out of here!
        if(!$this->edit) return;

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
