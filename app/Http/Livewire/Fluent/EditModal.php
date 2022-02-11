<?php

namespace App\Http\Livewire\Fluent;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public $ref;
    public $path;
    public $default;
    public $values;

    public function mount($ref, $path, $default, $values)
    {
        $this->ref = $ref;
        $this->path = $path;
        $this->default = $default;
        $this->values = $values;
    }

    public function render()
    {
        return view('livewire.fluent.edit-modal');
    }
}
