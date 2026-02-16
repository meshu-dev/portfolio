<?php

use App\Actions\Technology\{
    CreateTechnologyAction,
    DeleteTechnologyAction,
    GetAllTechnologiesAction,
    SearchTechnologiesAction
};
use App\View\Components\BaseComponent;
use Illuminate\Support\Collection;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Locked]
    public string $search = '';

    #[Locked]
    public bool $modal = false;

    #[Locked]
    public int $deleteId = 0;

    #[Locked]
    public string $deleteItemName = '';

    #[Locked]
    public bool $deleteModal = false;

    #[Validate('required|unique:App\Models\Technology,name')]
    public string $technologyName = '';

    #[Locked]
    public Collection $technologies;

    public function updatingSearch($value, $key)
    {
        $this->technologies = resolve(SearchTechnologiesAction::class)->execute($value);
    }

    public function addTechnology()
    {
        $this->validate();

        resolve(CreateTechnologyAction::class)->execute($this->technologyName);

        $this->search = '';
        $this->technologyName = '';
        $this->modal = false;

        $this->technologies = resolve(GetAllTechnologiesAction::class)->execute();

        $this->success('New technology has been added');
    }

    public function showDeleteModal(int $id, string $itemName)
    {
        $this->deleteId = $id;
        $this->deleteItemName = $itemName;
        $this->deleteModal = true;
    }

    #[On('confirm-delete')]
    public function onConfirmDelete(int $id)
    {
        resolve(DeleteTechnologyAction::class)->execute($id);
        $this->success('Technology has been deleted');
    }

    public function mount()
    {
        $this->technologies = resolve(GetAllTechnologiesAction::class)->execute();
    }
};
?>

<div>
    <livewire:header title="Technologies" />
    <div class="flex gap-4">
        <x-button
            label="Add"
            wire:click="modal = true"
            spinner
            class="flex-none btn-primary" />
        <div class="flex-1">
            <x-input
                placeholder="Search..."
                wire:model.live.debounce.300ms="search"
                clearable
                icon="o-magnifying-glass"
                 />
        </div>
    </div>
    <x-table
        :headers="[['key' => 'name', 'label' => 'Technology']]"
        :rows="$technologies"
        no-headers
        no-hover
        class="mt-4">
        @scope('actions', $technology)
            <x-button
                icon="o-trash"
                wire:click="showDeleteModal({{ $technology->id }}, '{{ $technology->name }}')"
                class="btn-sm" />
        @endscope
    </x-table>
    <x-modal title="Add Technology" wire:model="modal">
        <x-form wire:submit="addTechnology" no-separator>
            <x-input label="Name" wire:model="technologyName" />
            <x-slot:actions>
                <x-button label="Cancel" wire:click="deleteModal = true" />
                <x-button label="Submit" class="btn-primary" type="submit" />
            </x-slot:actions>
        </x-form>
    </x-modal>
    <livewire:delete-modal
        :id="$deleteId"
        :itemName="$deleteItemName"
        wire:model="deleteModal" />
</div>