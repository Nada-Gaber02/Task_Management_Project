<div class="task-app">
    <header class="app-header">
        <div class="container">
            <nav class="navbar app-navbar px-0" aria-label="Main navigation">
                <a class="brand-link" href="/" aria-label="TaskFlow home">
                    <span class="brand-mark" aria-hidden="true">T</span>
                    <span>Task<span class="brand-accent">Flow</span></span>
                </a>
                <a class="btn btn-sm btn-outline-primary header-action" href="/">Back to tasks <span aria-hidden="true">→</span></a>
            </nav>
        </div>
    </header>

    <main class="container page-content edit-page-content">
        <a class="back-link" href="/"><span aria-hidden="true">←</span> All tasks</a>

        <section class="edit-layout">
            <div class="edit-intro">
                <p class="eyebrow mb-2">MAKE IT YOURS</p>
                <h1 class="welcome-title">Refine your <span>next step.</span></h1>
                <p class="welcome-copy">A quick update is all it takes to keep your plan on track.</p>
                <div class="edit-task-preview">
                    <span class="preview-label">EDITING TASK</span>
                </div>
            </div>

            <section class="panel-card edit-panel" aria-labelledby="edit-task-heading">
                <div class="panel-heading">
                    <div>
                        <p class="eyebrow mb-1">TASK DETAILS</p>
                        <h2 class="panel-title" id="edit-task-heading">Edit task</h2>
                    </div>
                    <span class="heading-mark heading-mark-edit" aria-hidden="true">✎</span>
                </div>

                <form wire:submit.prevent="update" class="task-form">
                    <div class="mb-3">
                        <label class="form-label" for="task-title">Task name</label>
                        <input
                            class="form-control @error('title') is-invalid @enderror"
                            id="task-title"
                            type="text"
                            name="title"
                            wire:model="title"
                            placeholder="Give your task a clear name"
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
                            rows="4"
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
                        <label class="form-check-label" for="task-completed">Mark this task as completed</label>
                    </div>

                    <div class="d-flex flex-column flex-sm-row gap-2">
                        <button class="btn btn-primary submit-button flex-grow-1" type="submit">
                            <span wire:loading.remove wire:target="update">Save changes <span aria-hidden="true">→</span></span>
                            <span wire:loading wire:target="update">Saving changes…</span>
                        </button>
                        <a class="btn btn-light cancel-button" href="/">Cancel</a>
                    </div>
                </form>
            </section>
        </section>

        <footer class="app-footer">
            <span>Made for your next big thing.</span>
            <span>TaskFlow workspace</span>
        </footer>
    </main>
</div>
