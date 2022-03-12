<?php

namespace App\Http\Livewire\Shrine;

use Livewire\Component;

class EditLoader extends Component
{
    public $slot;

    public function render()
    {
        return view('livewire.shrine.edit-loader');
    }
}
