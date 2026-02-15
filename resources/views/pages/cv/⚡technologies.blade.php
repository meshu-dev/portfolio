<?php

use App\Actions\Technology\{
    DeleteTechnologyAction,
    GetAllTechnologiesAction,
    SearchTechnologiesAction
};
use App\View\Components\BaseComponent;
use Livewire\Attributes\Validate;
use Illuminate\Support\Collection;

new class extends BaseComponent
{
    public string $search = '';

    #[Locked]
    public Collection $technologies;

    public function updatingSearch($value, $key)
    {
        $this->technologies = resolve(SearchTechnologiesAction::class)->execute($value);
    }

    public function deleteTechnology(int $id)
    {
        resolve(DeleteTechnologyAction::class)->execute($id);
    }

    public function mount()
    {
        $this->technologies = resolve(GetAllTechnologiesAction::class)->execute();
    }
};
?>

<div>
    <livewire:header title="Technologies" />
    <x-input
        placeholder="Search..."
        wire:model.live.debounce.300ms="search"
        clearable
        icon="o-magnifying-glass" />
    <x-table
        :headers="[['key' => 'name', 'label' => 'Technology']]"
        :rows="$technologies"
        no-headers
        no-hover
        class="mt-4">
        @scope('actions', $technology)
            <x-button
                icon="o-trash"
                wire:click="deleteTechnology({{ $technology->id }})"
                spinner
                class="btn-sm" />
        @endscope
    </x-table>
</div>