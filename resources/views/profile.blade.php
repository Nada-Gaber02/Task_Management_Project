<x-app-layout>
    <x-slot name="header">
        <div>
            <p class="eyebrow mb-2">ACCOUNT SETTINGS</p>
            <h1 class="welcome-title">Your <span>profile.</span></h1>
            <p class="welcome-copy mb-0">Keep your account details and security up to date.</p>
        </div>
    </x-slot>

    <div class="profile-stack">
        <section class="profile-panel" aria-label="{{ __('Profile information') }}">
            <livewire:profile.update-profile-information-form />
        </section>

        <section class="profile-panel" aria-label="{{ __('Update password') }}">
            <livewire:profile.update-password-form />
        </section>

        <section class="profile-panel" aria-label="{{ __('Delete account') }}">
            <livewire:profile.delete-user-form />
        </section>
    </div>
</x-app-layout>
