<?php

use App\Actions\Cv\GetCvAction;
use Livewire\Component;

new class extends Component
{
    protected array $cv;

    public function boot() 
    {
        $this->cv = resolve(GetCvAction::class)->execute();
    }
};
?>

<div>
    {{-- Simplicity is the consequence of refined emotions. - Jean D'Alembert --}}
    <div>CV Form!!!</div>
    {{ dd($this->cv) }}
</div>