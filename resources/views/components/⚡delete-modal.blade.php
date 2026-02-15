<?php

use Livewire\Attributes\Reactive;
use Livewire\Attributes\Modelable;
use App\View\Components\BaseComponent;

new class extends BaseComponent
{
    #[Reactive]
    public int $id;

    #[Reactive]
    public string $itemName;

    #[Modelable]
    public bool $modal;

    public function confirmCancel()
    {
        $this->modal = false;
    }

    public function confirmDelete()
    {
        $this->modal = false;
        $this->dispatch('confirm-delete', id: $this->id);
    }
};
?>

<x-modal title="Confirm Delete" wire:model="modal">
    <x-form wire:submit="confirmDelete" no-separator>
        <div>Are you sure you want to delete {{ $itemName }}?</div>
        <x-slot:actions>
            <x-button label="Cancel" wire:click="confirmCancel" />
            <x-button label="Submit" class="btn-primary" type="submit" />
        </x-slot:actions>
    </x-form>
</x-modal>
