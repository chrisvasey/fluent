<?php

namespace App\Http\Livewire\Shrine;

use Livewire\Component;

class ShrineLoader extends Component
{
    public $routes = ['home'];
    public $slug;
    public $edit;

    public function mount($slug, $edit = false)
    {
        $this->edit = $edit;

        if(!$this->checkValidRoute($slug)){
            return Abort(404);
        }

        $this->slug = $slug;
    }

    public function checkValidRoute($slug)
    {
        return in_array($slug, $this->routes);
    }

    public function render()
    {
        return view('livewire.shrine.shrine-loader')->layout('layouts.guest');
    }
}
