<?php

use App\Actions\Cv\{GetProfileV2Action, UpdateProfileAction};
use App\View\Components\BaseComponent;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Validate('required|string')]
    public $intro;
 
    #[Validate('required|string')]
    public $location;

    public function save()
    {
        $this->validate();

        resolve(UpdateProfileAction::class)->execute($this->intro, $this->location);

        $this->success('Profile has been updated');
    }

    public function mount()
    {
        $profile = resolve(GetProfileV2Action::class)->execute();

        $this->intro    = $profile['intro'];
        $this->location = $profile['location'];
    }
};
?>

<div>
    <x-header title="Profile" separator />
    <x-form wire:submit="save">
        <x-input label="Intro" wire:model="intro" />
        <x-input label="Location" wire:model="location" />
        <x-slot:actions>
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>