<?php

namespace App\Http\Livewire;

use App\Models\Investigation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class CreateInvestigationForm extends Component
{
    public $title;
    public $notes;
    public $image;
    public $image_hash;
    public $investigation;

    protected $rules = [
        'title' => 'required|min:6',
        'image' => 'required',
        'image_hash' => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function createInvestigation()
    {
        $this->validate();

        $this->investigation = Investigation::create([
            'title' => $this->title,
            'notes' => $this->notes,
            'image' => $this->image,
            'image_hash' => $this->image_hash,
            'team_id' => $this->getTeamProperty()->id,
        ]);

        $this->title = '';
        $this->notes = '';
        $this->image = '';
        $this->image_hash = '';

        session()->flash('success_message', 'Investigation successfully created.');
    }

    /**
     * Get the current user of the application.
     *
     * @return mixed
     */
    public function getUserProperty()
    {
        return Auth::user();
    }

    /**
     * Get the current user's team.
     *
     * @return mixed
     */
    public function getTeamProperty()
    {
        return Auth::user()->currentTeam;
    }

    public function render()
    {
        return view('livewire.create-investigation-form');
    }
}
