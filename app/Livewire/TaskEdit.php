<?php

namespace App\Livewire;

use Livewire\Attributes\Layout;
use App\Models\Task;
use Livewire\Component;

#[Layout('layouts.app')]
class TaskEdit extends Component
{
    public $taskId;
    public $title;
    public $description;
    public $due_date;
    public $is_completed;

    protected $rules =[
        'title' => 'required|string|max:255',
        'description' => 'nullable|string',
        'due_date' => 'required|date',
        'is_completed' => 'boolean',
    ];

    //إحنا عملنا mount() عشان نمسك الـ ID اللي جاي من الـ URL ونخزنه داخل الـ Component.
    public function mount($taskId){
        $this->taskId = $taskId;
        $task = auth()->user()->tasks()->findOrFail($taskId);
        $this->title = $task->title;
        $this->description = $task->description;
        $this->due_date = $task->due_date;
        $this->is_completed = $task->is_completed;
    }

    public function update(){
        $this->validate($this->rules);
        $task = auth()->user()->tasks()->findOrFail($this->taskId);
        $task->update([
        'title' => $this->title,
        'description' => $this->description,
        'due_date' => $this->due_date,
        'is_completed' => $this->is_completed,
    ]);
    return redirect('/');
    }

    public function render()
    {
        $task = auth()->user()->tasks()->findOrFail($this->taskId);
        return view('livewire.task-edit', ['task' => $task]);
    }
}
