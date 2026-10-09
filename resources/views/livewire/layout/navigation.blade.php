<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<header class="app-header container">
    <nav class="navbar app-navbar container" aria-label="Main navigation">
        <a class="brand-link" href="{{ route('dashboard') }}" wire:navigate aria-label="TaskFlow home">
            <span class="brand-mark" aria-hidden="true">T</span>
            <span>Task<span class="brand-accent">Flow</span></span>
        </a>

        <button type="button" wire:click="logout" class="btn btn-sm btn-outline-primary ms-auto">
            {{ __('Log Out') }}
        </button>
    </nav>
</header>
