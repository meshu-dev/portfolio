<?php

use App\Actions\Cv\WorkExperience\{GetWorkExperiencesAction, DeleteWorkExperienceAction};
use App\View\Components\BaseComponent;
use Livewire\Attributes\On;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Locked]
    public $workExperiences;

    #[Locked]
    public bool $modal = false;

    #[Locked]
    public int $deleteId = 0;

    #[Locked]
    public string $deleteItemName = '';

    public function showDeleteModal(int $id, string $itemName)
    {
        $this->deleteId       = $id;
        $this->deleteItemName = $itemName;
        $this->modal          = true;
    }

    #[On('confirm-delete')]
    public function onConfirmDelete(int $id)
    {
        resolve(DeleteWorkExperienceAction::class)->execute($id);
        $this->success('Technology has been deleted');
    }

    public function mount()
    {
        $this->workExperiences = resolve(GetWorkExperiencesAction::class)->execute();
    }
};
?>

<div>
    <livewire:header title="Work Experience List" />
    @foreach($workExperiences as $workExperience)
        <x-list-item
            :item="$workExperience"
            value="title"
            sub-value="company"
            link="/work-experiences/{{ $workExperience->id }}">
            <x-slot:actions>
                <x-button
                    icon="o-trash"
                    class="btn-sm"
                    wire:click="showDeleteModal({{ $workExperience->id }}, '{{ $workExperience->title }}')" />
            </x-slot:actions>
        </x-list-item>
    @endforeach
    <livewire:delete-modal
        :id="$deleteId"
        :itemName="$deleteItemName"
        wire:model="modal" />
</div>
