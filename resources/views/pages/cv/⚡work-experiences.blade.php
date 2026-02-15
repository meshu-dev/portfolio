<?php

use App\Actions\Cv\GetWorkExperiencesAction;
use App\View\Components\BaseComponent;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Locked]
    public $workExperiences;

    public function mount()
    {
        $this->workExperiences = resolve(GetWorkExperiencesAction::class)->execute();
    }
};
?>

<div>
    <x-header title="Work Experience List" separator />
    @foreach($workExperiences as $workExperience)
        <x-list-item
            :item="$workExperience"
            value="title"
            sub-value="company"
            link="/work-experiences/{{ $workExperience->id }}">
            <x-slot:actions>
                <x-button icon="o-trash" class="btn-sm" wire:click="delete(1)" spinner />
            </x-slot:actions>
        </x-list-item>
    @endforeach
</div>