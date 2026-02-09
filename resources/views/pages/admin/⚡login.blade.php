<?php

use Livewire\Component;

new class extends Component
{
    public string $email;
 
    public string $password;
 
    public function save()
    {
        $this->validate([
            'email'      => 'required|email',
            'password'   => 'required|string',
        ]);

        $params = [
            'email' => $this->email,
            'password' => $this->password
        ];

        if (Auth::attempt($params)) {
            session()->regenerate();
            $this->redirectRoute('admin.cv');
        }
    }
};
?>

<div>
    {{-- It is never too late to be what you might have been. - George Eliot --}}
    <div class="bg-red-300">Energy</div>
    <form wire:submit="save">
        @error('email') <span style="color: red;">{{ $message }}</span> @enderror
        <div>
            <label>Email</label>
            <input type="email" wire:model="email" />
        </div>
        @error('password') <span style="color: red;">{{ $message }}</span> @enderror
        <div>
            <label>Password</label>
            <input type="password" wire:model="password" />
        </div>
        <input type="submit" class="button cursor-pointer" value="Submit" />
    </div>
</div>