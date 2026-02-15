<?php

use App\Actions\Cv\{GetSkillsAction, UpdateSkillTechnologiesAction};
use App\Actions\Technology\GetAllTechnologiesAction;
use App\View\Components\BaseComponent;
use Livewire\Attributes\Validate;

new class extends BaseComponent
{
    #[Locked]
    public $skills;
 
    #[Locked]
    public $technologies;

    #[Validate('required|array|distinct')]
    public $selected;

    public function save()
    {
        $this->validate();

        resolve(UpdateSkillTechnologiesAction::class)->execute($this->selected);

        $this->success('Skills have been updated');
    }

    public function mount()
    {
        $this->skills = resolve(GetSkillsAction::class)->execute();

        $technologies = resolve(GetAllTechnologiesAction::class)->execute();
        $this->technologies = $technologies->map(function ($technology) {
            return (object) ['id' => $technology->id, 'name' => $technology->name];
        });

        $this->selected = $this->skills->mapWithKeys(function ($skill) {
            return [$skill->id => $skill->technologies->pluck('id')];
        });
    }
};
?>

<div>
    <livewire:header title="Skills" />
    <x-form wire:submit="save">
        @foreach ($skills as $skill)
            <x-choices-offline
                :label="$skill->name"
                wire:model="selected.{{$skill->id}}"
                :options="$this->technologies"
                placeholder="Search..."
                clearable
                searchable /> 
        @endforeach
        <x-slot:actions>
            <x-button label="Save" class="btn-primary" type="submit" spinner="save" />
        </x-slot:actions>
    </x-form>
</div>