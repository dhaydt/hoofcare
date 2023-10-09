<?php

namespace App\Filament\Auth;

use App\Models\User;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Component;
use Filament\Pages\Auth\Login as BaseAuth;

class Login extends BaseAuth
{
    public function form(Form $form): Form
    {
        return $form
            ->schema([
                $this->getEmailFormComponent(),
                // $this->getLoginFormComponent(), 
                $this->getPasswordFormComponent(),
                $this->getRememberFormComponent(),
            ])
            ->statePath('data');
    }

    protected function getLoginFormComponent(): Component
    {
        return TextInput::make('login')
            ->label('Login')
            ->required()
            ->autocomplete()
            ->autofocus();
    }

    protected function getCredentialsFromFormData(array $data): array
    {
        $check = User::where('email', $data['email'])->first();

        if ($check) {
            if ($check['user_is'] == 'user') {
                return [
                    'email' => '000@mail.com',
                    'password'  => 'no_access',
                ];
            }
        }
        return [
            'email' => $data['email'],
            'password'  => $data['password'],
        ];
    }
}
