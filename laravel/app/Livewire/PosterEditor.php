<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Project;

class PosterEditor extends Component
{
    use WithFileUploads;

    public $projectId = '';
    public $templateId = '';
    public $petName = '';
    public $petDescription = '';
    public $petBreed = '';
    public $petAge = '';
    public $petSex = '';
    public $contactPerson = '';
    public $contactNumber = '';
    public $petImage;

    protected $listeners = [
        'refreshPreview' => 'reloadPreview',
        'switchTemplate' => 'updateTemplate'
    ];

    public function mount($templateId, $petName, $petDescription, $petBreed, $petAge, $petSex, $contactPerson, $contactNumber, $petImage)
    {
        $this->templateId = $templateId;
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
        $templateView = null;

        if ($this->templateId === 'template-1') {
            $templateView = 'livewire.template-1';
        } elseif ($this->templateId === 'template-2') {
            $templateView = 'livewire.template-2';
        }

        return view($templateView, [
            'templateView' => $templateView,
        ]);
    }

    public function updateTemplate($newTemplateId)
    {
        $this->templateId = $newTemplateId;

        $project = Project::find($this->projectId);
        $project->template_id = $newTemplateId;
        $project->save();
    }

    public function reloadPreview()
    {
        $this->petName = $this->petName;
    }
}
