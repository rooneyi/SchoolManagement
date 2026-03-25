<?php

namespace App\Livewire\Organigram;

use App\Models\School;
use App\Models\User;
use App\Models\SchoolBibliography;
use Livewire\Component;

class Kanban extends Component
{
    public School $school;
    public $personnels;
    public $bibliographies;

    public function mount(School $school)
    {
        $this->school = $school;
        $this->personnels = User::where('school_id', $school->id)->get();
        $this->bibliographies = SchoolBibliography::where('school_id', $school->id)->get();
    }

    public function render()
    {
        return view('livewire.organigram.kanban');
    }
}
