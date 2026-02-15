<?php

use Livewire\Component;

new class extends Component
{
    public $title;
};
?>

<div>
    <x-header :title="$title" separator class="!mb-4" />
</div>