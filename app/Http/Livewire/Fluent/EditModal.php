<?php

namespace App\Http\Livewire\Fluent;
use stdClass;
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

    public function writeToJsonFile($locale)
    {
        // If value hasn't changed, skip read/write cycle.
        if($locale['value'] != $locale['old_value']){
            // Get lang file data or create empty Object if it doesn't exist
            $data = json_decode(Storage::disk('lang')->get("{$locale['path']}.json", true)) ?? new stdClass();

            // Update field value
            $data->{$this->ref} = $locale['value'];

            // Write updated data to file
            Storage::disk('lang')->put("{$locale['path']}.json", json_encode($data));
        };

        // Close modal
        $this->emit('closeModal');
    }

    public function save()
    {
        // Write a value for each field
        collect($this->values)->each(function ($value) {
            $this->writeToJsonFile($value);
        });

        //Refresh values of Fluent components
        $this->emit('componentSaved');
    }

    public function render()
    {
        return view('livewire.fluent.edit-modal');
    }
}
