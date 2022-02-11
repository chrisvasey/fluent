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
    public $edit = true;
    // public $attributes;

    public function retreiveStoredValue()
    {
        // Attempt to retrieve a stored value for this ref
        $storedValue = json_decode(Storage::disk('local')->get("fluent/{$this->path}.json"), true);

        // If we have no file at all, create one with this ref and value
        if(!$storedValue){
            Storage::disk('local')->put("fluent/{$this->path}.json", json_encode([
                $this->ref => $this->default
            ]));
        }


        return $storedValue[$this->ref] ?? $this->default;
    }

    public function render()
    {

        $this->output = $this->retreiveStoredValue();


        return view('livewire.fluent.h2');
    }
}
