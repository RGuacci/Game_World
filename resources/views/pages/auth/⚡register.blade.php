<?php

use Livewire\Component;
use App\Actions\Fortify\CreateNewUser;

new class extends Component
{
    public string $name;
    public string $username;
    public string $email;
    public string $password;
    public string $password_confirmation;

    public function register(CreateNewUser $creator)
    {
        $data = $this->validate([
            'name' => 'required|string|max:30',
            'username' => 'required|string|max:30|unique:users,username',
            'email' => 'required|email|max:30',
            'password' => 'required|min:8|max:30|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = $creator->create($data);
        Auth::login($user);
        session()->flash('success','Account created successfully!');
        return $this->redirectRoute('home');
    }
};
?>

<main class="min-h-screen mt-16 flex justify-center items-center">
    <form class="w-xl text-center" wire:submit="register">
        <h1 class="text-4xl mb-10 md:mb-20">Register Page</h1>
      <flux:input label="Name" type="text" class="mb-5 md:mb-10 text-2xl" wire:model="name" />
      <flux:input label="Username" type="text" class="mb-5 md:mb-10 text-2xl" wire:model="username" />
      <flux:input label="Email" type="email" class="mb-5 md:mb-10 text-2xl" wire:model="email" />
      <flux:input label="Password" type="password" class="mb-5 md:mb-10 text-2xl" wire:model="password" />
      <flux:input label="Confirm Password" type="password" class="mb-5 md:mb-10 text-2xl" wire:model="password_confirmation" />
      <flux:button type="submit">Sign Up</flux:button>
    </form>
</main>