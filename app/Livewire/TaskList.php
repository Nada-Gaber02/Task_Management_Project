<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use Livewire\Component;
use App\Models\Task;
use App\Livewire\Actions\Logout as LogoutAction;

#[Layout('layouts.app')]
class TaskList extends Component
{
    public $taskId;
    public $title;
    public $description;
    public $due_date;
    public $is_completed = false;

    protected $rules =[
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'required|date',
        'is_completed' => 'boolean',
    ];
    public function save()
    {
        $this->validate($this->rules);

        auth()->user()->tasks()->create([
            'title' => $this->title,
            'description' => $this->description,
            'due_date' => $this->due_date,
            'is_completed' => $this->is_completed,
        ]);

        $this->reset([
            'title',
            'description',
            'due_date',
            'is_completed',
        ]);
    }

    public function delete($taskId){
        $task = auth()->user()->tasks()->findOrFail($taskId);
        $task->delete();
    }

    public function logout(LogoutAction $logout): void
    {
        $logout();

        $this->redirect('/login', navigate: true);
    }

    public function render()
    {
        $tasks = auth()->user()->tasks()->get();

    return view('livewire.task-list', ['tasks' => $tasks]);
    }
}
