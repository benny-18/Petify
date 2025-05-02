<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Project;

// class PosterEditor extends Component
// {
//     use WithFileUploads;
//     protected $listeners = ['refreshPreview' => 'reloadPreview'];

//     public $petName = '';
//     public $petDescription = '';
//     public $petBreed = '';
//     public $contactPerson = '';
//     public $contactNumber = '';
//     public $petAge = '';
//     public $petSex = '';
//     public $petImage;

//     public function render()
//     {
//         return view('livewire.poster-editor');
//     }

//     public function reloadPreview()
//     {
//         // Optionally fetch from DB again if needed
//         $project = Project::find($this->projectId);
//         $this->petName = $project->pet_name;

//         $this->petName = $this->petName; // Triggers re-render if needed
//     }

// }

class PosterEditor extends Component
{
    use WithFileUploads;

    public $petName = '';
    public $petDescription = '';
    public $petBreed = '';
    public $petAge = '';
    public $petSex = '';
    public $contactPerson = '';
    public $contactNumber = '';
    public $petImage;

    protected $listeners = ['refreshPreview' => 'reloadPreview'];

    public function mount($petName, $petDescription, $petBreed, $petAge, $petSex, $contactPerson, $contactNumber, $petImage)
    {
        $this->petName = $petName;
        $this->petDescription = $petDescription;
        $this->petBreed = $petBreed;
        $this->petAge = $petAge;
        $this->petSex = $petSex;
        $this->contactPerson = $contactPerson;
        $this->contactNumber = $contactNumber;
        $this->petImage = $petImage;
    }

    public function render()
    {
        return view('livewire.poster-editor');
    }

    public function reloadPreview()
    {
        // No need to emit anything. Livewire will re-render if public properties change.
        // If needed, you can manipulate something to trigger the render like:
        $this->petName = $this->petName;
    }
}
