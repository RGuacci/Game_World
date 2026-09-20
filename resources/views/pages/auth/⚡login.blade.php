<?php

use Livewire\Component;

new class extends Component {
    
    public string $login = '';
    public string $password = '';

    public function loginUser()
    {
        $data = $this->validate([
          'login' => 'required|string',
          'password' => 'required|string'
        ]);

        $field = filter_var($this->login,FILTER_VALIDATE_EMAIL) ? 'email' : 'username' ;

        if(Auth::attempt([
            $field => $data['login'],
            'password' =>$data['password']
        ])){
            session()->regenerate();
            session()->flash('succes','Login completed successfully');
            return $this->redirectRoute('home');
        }
        $this->addError('login',`Credentials don't exist.`);

    }

};
?>

<main class="min-h-screen mt-16 flex justify-center items-center">
    <form class="w-xl text-center" wire:submit="loginUser">
        <h1 class="text-4xl mb-10 md:mb-20">Login Page</h1>
        <flux:input label="Username/Email" type="text" class="mb-5 md:mb-10 text-2xl" wire:model="login" />
        <flux:input label="Password" type="password" class="mb-5 md:mb-10 text-2xl" wire:model="password" />
        <flux:button type="submit">Login</flux:button>
    </form>
</main>
