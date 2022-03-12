<?php

namespace App\Http\Livewire\Shrine\Pages;

use Livewire\Component;

class Home extends Component
{
    public $slug;

    public function render()
    {
        return view('livewire.shrine.pages.home');
    }
}
