<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Http\Response;
use Livewire\Component;

class SetStatus extends Component
{
    public $idea;
    public $statuses;
    public $status;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
        $this->statuses = [
            1 => [
                'label' => 'Open',
                'classes' => 'text-gray-600'
            ],
            2 => [
                'label' => 'Considering',
                'classes' => 'text-purple'
            ],
            3 => [
                'label' => 'In Progress',
                'classes' => 'text-yellow'
            ],
            4 => [
                'label' => 'Implemented',
                'classes' => 'text-red'
            ],
            5 => [
                'label' => 'Closed',
                'classes' => 'text-green'
            ],
        ];
    }

    public function setStatus()
    {
        if (! auth()->check() || !auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        $this->emit('statusWasUpdated');
    }

    public function render()
    {
        return view('livewire.set-status');
    }
}
