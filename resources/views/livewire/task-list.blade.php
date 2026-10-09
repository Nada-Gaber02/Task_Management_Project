<div class="task-app container">
    @unless (request()->routeIs('dashboard'))

    @endunless

    <main class="container page-content">
        <section class="welcome-section">
            <div>
                <p class="eyebrow mb-2">YOUR PERSONAL WORKSPACE</p>
                <h1 class="welcome-title">Make room for <span>great work.</span></h1>
                <p class="welcome-copy mb-0">Keep your priorities clear and your day moving forward.</p>
            </div>
            <div class="welcome-date">
                <span class="date-indicator" aria-hidden="true"></span>
                <span>One step at a time</span>
            </div>
        </section>

        @php
            $completedTasks = $tasks->where('is_completed', true)->count();
            $pendingTasks = $tasks->count() - $completedTasks;
        @endphp

        <section class="row g-3 stats-row" aria-label="Task overview">
            <div class="col-12 col-sm-4">
                <article class="stat-card">
                    <span class="stat-icon stat-icon-purple" aria-hidden="true">◎</span>
                    <div>
                        <p class="stat-label">All tasks</p>
                        <p class="stat-value">{{ $tasks->count() }}</p>
                    </div>
                </article>
            </div>
            <div class="col-12 col-sm-4">
                <article class="stat-card">
                    <span class="stat-icon stat-icon-green" aria-hidden="true">✓</span>
                    <div>
                        <p class="stat-label">Completed</p>
                        <p class="stat-value">{{ $completedTasks }}</p>
                    </div>
                </article>
            </div>
            <div class="col-12 col-sm-4">
                <article class="stat-card">
                    <span class="stat-icon stat-icon-orange" aria-hidden="true">◷</span>
                    <div>
                        <p class="stat-label">In progress</p>
                        <p class="stat-value">{{ $pendingTasks }}</p>
                    </div>
                </article>
            </div>
        </section>

        <div class="row g-4 dashboard-grid">
            <section class="col-12 col-lg-5 col-xl-4" id="create-task">
                <div class="panel-card create-panel">
                    <div class="panel-heading">
                        <div>
                            <p class="eyebrow mb-1">START SOMETHING</p>
                            <h2 class="panel-title">Create a task</h2>
                        </div>
                        <span class="heading-mark" aria-hidden="true">+</span>
                    </div>

                    <form wire:submit.prevent="save" class="task-form">
                        <div class="mb-3">
                            <label class="form-label" for="task-title">Task name</label>
                            <input
                                class="form-control @error('title') is-invalid @enderror"
                                id="task-title"
                                type="text"
                                name="title"
                                wire:model="title"
                                placeholder="e.g. Prepare project proposal"
                                autocomplete="off"
                            >
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label" for="task-description">Description <span class="optional-label">Optional</span></label>
                            <textarea
                                class="form-control @error('description') is-invalid @enderror"
                                id="task-description"
                                name="description"
                                wire:model="description"
                                rows="3"
                                placeholder="Add a few details to keep you on track"
                            ></textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label class="form-label" for="task-due-date">Due date</label>
                            <input
                                class="form-control @error('due_date') is-invalid @enderror"
                                id="task-due-date"
                                type="date"
                                name="due_date"
                                wire:model="due_date"
                            >
                            @error('due_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check completion-check mb-4">
                            <input class="form-check-input" id="task-completed" type="checkbox" name="is_completed" wire:model="is_completed">
                            <label class="form-check-label" for="task-completed">Already completed</label>
                        </div>

                        <button class="btn btn-primary w-100 submit-button" type="submit">
                            <span wire:loading.remove wire:target="save">Add task <span aria-hidden="true">→</span></span>
                            <span wire:loading wire:target="save">Adding task…</span>
                        </button>
                    </form>
                </div>
                <p class="form-note"><span aria-hidden="true">✦</span> Small steps add up to big progress.</p>
            </section>

            <section class="col-12 col-lg-7 col-xl-8" aria-labelledby="tasks-heading">
                <div class="tasks-section-heading">
                    <div>
                        <p class="eyebrow mb-1">YOUR PRIORITIES</p>
                        <h2 class="panel-title" id="tasks-heading">All tasks <span class="task-count">{{ $tasks->count() }}</span></h2>
                    </div>
                </div>

                <div class="task-list">
                    @forelse ($tasks as $task)
                        <article class="task-card {{ $task->is_completed ? 'task-card-complete' : '' }}">
                            <div class="task-status-rail" aria-hidden="true"></div>
                            <div class="task-card-content">
                                <div class="task-card-top">
                                    <div class="task-title-wrap">
                                        <span class="task-number">TASK {{ str_pad($task->id, 2, '0', STR_PAD_LEFT) }}</span>
                                        <h3 class="task-title">{{ $task->title }}</h3>
                                    </div>
                                    <span class="status-badge {{ $task->is_completed ? 'status-complete' : 'status-pending' }}">
                                        <span class="status-dot" aria-hidden="true"></span>
                                        {{ $task->is_completed ? 'Completed' : 'In progress' }}
                                    </span>
                                </div>

                                @if ($task->description)
                                    <p class="task-description">{{ $task->description }}</p>
                                @else
                                    <p class="task-description task-description-muted">No description added.</p>
                                @endif

                                <div class="task-card-bottom">
                                    <span class="task-due"><span class="due-icon" aria-hidden="true">◷</span> Due {{ $task->due_date }}</span>
                                    <div class="task-actions">
                                        <a class="task-action edit-action" href="/tasks/{{ $task->id }}/edit">Edit</a>
                                        <button class="task-action delete-action" type="button" wire:click="delete({{ $task->id }})">Delete</button>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @empty
                        <div class="empty-state">
                            <div class="empty-state-icon" aria-hidden="true">✦</div>
                            <h3>Nothing on your list yet</h3>
                            <p>Create your first task and turn a good intention into a plan.</p>
                            <a class="btn btn-primary" href="#create-task">Create your first task</a>
                        </div>
                    @endforelse
                </div>
            </section>
        </div>

        <footer class="app-footer">
            <span>Made for your next big thing.</span>
            <span>{{ $completedTasks }} of {{ $tasks->count() }} tasks completed</span>
        </footer>
    </main>
</div>
