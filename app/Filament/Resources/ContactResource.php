<?php

namespace App\Filament\Resources;

use App\CPU\Helpers;
use App\Filament\Resources\ContactResource\Pages;
use App\Filament\Resources\ContactResource\RelationManagers;
use App\Models\Category;
use App\Models\Contact;
use App\Models\Service;
use Filament\Forms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use stdClass;

class ContactResource extends Resource
{
    protected static ?string $model = Contact::class;

    protected static ?string $navigationIcon = 'heroicon-o-identification';

    protected static ?string $navigationGroup = 'Contact';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('f_name')
                    ->required()
                    ->label('First name')
                    ->maxLength(100),
                Forms\Components\TextInput::make('l_name')
                    ->maxLength(100)
                    ->label('Last name'),
                Forms\Components\TextInput::make('business_name')
                    ->maxLength(200),
                Forms\Components\TextInput::make('zipcode')
                    ->required()
                    ->maxLength(100),
                Forms\Components\TextInput::make('country')
                    ->required()
                    ->maxLength(100),
                Forms\Components\Select::make('services')
                    ->placeholder('Select services offered')
                    ->label('Services offered')
                    ->options(Service::get()->pluck('name', 'name'))
                    ->multiple()
                    ->required(),
                Select::make('category_id')
                    ->label('Catgeories')
                    ->placeholder('Select Categories')
                    ->required()
                    ->options(Category::get()->pluck('name', 'name'))
                    ->multiple(),
                FileUpload::make('certifications')
                    ->image()
                    ->directory('certificate'),
                Forms\Components\TextInput::make('online_link_1')
                    ->maxLength(500),
                Forms\Components\TextInput::make('online_link_2')
                    ->maxLength(500),
                Forms\Components\TextInput::make('preferred_contact_method')
                    ->maxLength(500),
                Forms\Components\TextInput::make('phone')
                    ->tel()
                    ->maxLength(20),
                Forms\Components\TextInput::make('email')
                    ->email()
                    ->maxLength(200),
                Forms\Components\TextInput::make('text')
                    ->maxLength(500),
                Forms\Components\TextInput::make('messenger')
                    ->maxLength(500),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('f_name')
                    ->searchable()
                    ->label('First name'),
                Tables\Columns\TextColumn::make('l_name')
                    ->searchable()
                    ->label('Last name'),
                Tables\Columns\TextColumn::make('business_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('zipcode')
                    ->searchable(),
                Tables\Columns\TextColumn::make('country')
                    ->searchable(),
                Tables\Columns\TextColumn::make('services')
                    ->view('filament.resources.contacts.service')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category_id')
                    ->label('categories')
                    ->view('filament.resources.contacts.category')
                    ->searchable(),
                ImageColumn::make('certifications')
                    ->searchable(),
                Tables\Columns\TextColumn::make('online_link_1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('online_link_2')
                    ->searchable(),
                Tables\Columns\TextColumn::make('preferred_contact_method')
                    ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('text')
                    ->searchable(),
                Tables\Columns\TextColumn::make('messenger')
                    ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            //
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListContacts::route('/'),
            'create' => Pages\CreateContact::route('/create'),
            'edit' => Pages\EditContact::route('/{record}/edit'),
        ];
    }    
}
