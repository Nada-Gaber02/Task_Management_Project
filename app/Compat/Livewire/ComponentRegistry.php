<?php

namespace App\Compat\Livewire;

class ComponentRegistry
{
    public function getClass(string $name): ?string
    {
        if (class_exists($name) && is_subclass_of($name, \Livewire\Component::class)) {
            return $name;
        }

        if (! app()->bound('livewire.finder')) {
            return null;
        }

        $finder = app('livewire.finder');

        return $finder->resolveClassComponentClassName($name) ?: null;
    }
}
