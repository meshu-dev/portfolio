<?php

use App\Actions\Cv\WorkExperience\{GetWorkExperienceAction, UpdateWorkExperienceAction};
use App\View\Components\BaseComponent;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Url]
    public int $id;

    #[Validate('required|string')]
    public $title;

    #[Validate('required|string')]
    public $company;

    #[Validate('required|string')]
    public $location;

    #[Validate('required')]
    public $isCurrent;

    #[Validate('required')]
    public $startDate;

    #[Validate('required_if:is_current,false')]
    public $endDate;

    #[Validate('required')]
    public $description;

    #[Validate('required')]
    public $responsibilities;

    #[Validate('required')]
    public $active;

    private $maxResponsibilities = 5;

    public function addResponsibility()
    {
        $this->responsibilities[] = '';
    }

    public function removeResponsibility(int $index)
    {
        unset($this->responsibilities[$index]);
    }

    public function save()
    {
        $this->validate();

        resolve(UpdateWorkExperienceAction::class)->execute(
            $this->id,
            [
                'title'            => $this->title,
                'company'          => $this->company,
                'location'         => $this->location,
                'is_current'       => $this->isCurrent,
                'start_date'       => $this->startDate,
                'end_date'         => $this->endDate,
                'description'      => $this->description,
                'responsibilities' => $this->responsibilities,
                'active'           => $this->active,
            ]
        );

        $this->successWithRedirect(
            'Work experience have been updated',
            '/work-experiences'
        );
    }

    public function mount(int $id)
    {
        $workExperience = resolve(GetWorkExperienceAction::class)->execute($id);

        $this->id               = $id;
        $this->title            = $workExperience->title;
        $this->company          = $workExperience->company;
        $this->location         = $workExperience->location;
        $this->isCurrent        = $workExperience->is_current;
        $this->startDate        = $workExperience->start_date;
        $this->endDate          = $workExperience->end_date;
        $this->description      = $workExperience->description;
        $this->responsibilities = $workExperience->responsibilities;
        $this->active           = $workExperience->active;
    }
};
?>

<div>
    <livewire:header title="Work Experience" />
    <x-form wire:submit="save">
        <x-input label="Title" wire:model="title" />
        <x-input label="Company" wire:model="company" />
        <x-input label="Location" wire:model="location" />
        <x-toggle label="Current Employment" wire:model.live="isCurrent" right />
        <x-datepicker
            label="Start Date"
            wire:model="startDate"
            icon="o-calendar"
            :config="['altFormat' => 'Y-m-d']" />
        @if (!$isCurrent)
            <x-datepicker
                label="End Date"
                wire:model.live="endDate"
                icon="o-calendar"
                :config="['altFormat' => 'Y-m-d']" />
        @endif
        <x-input label="Description" wire:model="description" />
        <label class="text-xs">Responsibilities</label>
        <x-button
            label="Add"
            class="btn-primary w-20"
            wire:click="addResponsibility"
            :disabled="count($responsibilities) >= $this->maxResponsibilities ? true : false" />
        @foreach ($responsibilities as $index => $responsibility)
            <x-input wire:model="responsibilities.{{ $index }}">
                <x-slot:append>
                    <x-button
                        icon="o-trash"
                        class="btn-sm"
                        wire:click="removeResponsibility({{ $index }})" />
                </x-slot:append>
            </x-input>
        @endforeach
        <x-toggle label="Active" wire:model="active" right />
        <x-slot:actions>
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>