<?php

namespace App\Http\Livewire\Fluent;
use LivewireUI\Modal\ModalComponent;

class EditModal extends ModalComponent
{
    public function render()
    {
        return view('livewire.fluent.edit-modal');
    }
}
