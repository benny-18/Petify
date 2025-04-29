<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;

class PosterEditor extends Component
{
    use WithFileUploads;

    public $petName = '';
    public $petDescription = '';
    public $reward = '';
    public $contactNumber = '';
    public $petImage;

    public function render()
    {
        return view('livewire.poster-editor');
    }
}
