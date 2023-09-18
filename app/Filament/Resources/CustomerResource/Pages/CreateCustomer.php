<?php

namespace App\Filament\Resources\CustomerResource\Pages;

use App\Filament\Resources\CustomerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Hash;

class CreateCustomer extends CreateRecord
{
    protected static string $resource = CustomerResource::class;

    function mutateFormDataBeforeCreate(array $data): array
    {
        $data['user_is'] = 'user';
        $data['password'] = Hash::make('123456');

        return $data;
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
