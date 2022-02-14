<?php

namespace App\Http\Livewire\Fluent;
use LivewireUI\Modal\ModalComponent;
use Illuminate\Support\Facades\Storage;

class EditModal extends ModalComponent
{
    public $ref;
    public $default;
    public $values;

    public function mount($ref, $default, $values)
    {
        $this->ref = $ref;
        $this->default = $default;
        $this->values = $values;
    }

    public function writeToJsonFile($path, $value)
    {
        // Get lang file data
        $data = json_decode(Storage::disk('lang')->get("{$path}.json", true));

        // Update field value
        $data->{$this->ref} = $value;

        Storage::disk('lang')->put("{$path}.json", json_encode($data));
    }

    public function save()
    {
        collect($this->values)->each(function ($value, $key) {
            $this->writeToJsonFile($key, $value);
        });
    }

    public function render()
    {
        return view('livewire.fluent.edit-modal');
    }
}
