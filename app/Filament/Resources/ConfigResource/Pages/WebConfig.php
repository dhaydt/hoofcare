<?php

namespace App\Filament\Resources\ConfigResource\Pages;

use App\Filament\Resources\ConfigResource;
use Filament\Resources\Pages\Page;

class WebConfig extends Page
{
    protected static string $resource = ConfigResource::class;

    protected static string $view = 'filament.resources.config-resource.pages.web-config';
}
