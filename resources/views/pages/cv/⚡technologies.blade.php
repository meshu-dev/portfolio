<?php

use App\Actions\Technology\DeleteTechnologyAction;
use App\Actions\Technology\GetAllTechnologiesAction;
use App\View\Components\BaseComponent;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Locked]
    public $technologies;

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
    <x-header title="Technologies" separator />
    <x-table
        :headers="[['key' => 'name', 'label' => 'Technology']]"
        :rows="$technologies"
        no-headers
        no-hover>
        @scope('actions', $technology)
            <x-button
                icon="o-trash"
                wire:click="deleteTechnology({{ $technology->id }})"
                spinner
                class="btn-sm" />
        @endscope
    </x-table>
</div>