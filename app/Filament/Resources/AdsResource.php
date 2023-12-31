<?php

namespace App\Filament\Resources;

use App\CPU\Helpers;
use App\Filament\Resources\AdsResource\Pages;
use App\Filament\Resources\AdsResource\RelationManagers;
use App\Models\Ads;
use App\Models\Category;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Contracts\HasTable;
use stdClass;

class AdsResource extends Resource
{
    protected static ?string $model = Ads::class;

    protected static ?string $navigationIcon = 'heroicon-o-currency-dollar';

    protected static ?string $navigationGroup = 'Advertising';

    public static function form(Form $form): Form
    {
        $categories = Category::get();
        $newCat = ['home'];

        foreach ($categories as $c) {
            $newCat[$c['id']] = $c['name'];
            if(!isset($newCat[9999])){
                $newCat[9999] = 'item';
            };
            if(!isset($newCat[9998])){
                $newCat[9998] = 'contact';
            };
        }

        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->maxLength(200),
                Forms\Components\FileUpload::make('image')
                    ->directory('ads')
                    ->hint('Image Ratio: 1:7')
                    ->image(),
                // Forms\Components\Textarea::make('description')
                //     ->maxLength(65535)
                //     ->columnSpanFull(),
                Forms\Components\Select::make('show_in')
                    ->label('Show In / Page')
                    ->placeholder('Select page to show')
                    ->options($newCat)
                    ->required(),
                Forms\Components\TextInput::make('link')
                    ->label('Link to Ads Page')
                    ->maxLength(500),
                Forms\Components\Toggle::make('status')
                    ->default(1)
                    ->required(),
                // Forms\Components\DateTimePicker::make('start_at')
                //     ->required(),
                // Forms\Components\DateTimePicker::make('end_at')
                //     ->required(),
                // Forms\Components\TextInput::make('credit')
                //     ->required()
                //     ->maxLength(500)
                //     ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('title')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('image'),
                Tables\Columns\TextColumn::make('show_in')
                    ->label('Show In / Page')
                    ->formatStateUsing(fn(string $state): string => Helpers::getCategory($state))
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                TextColumn::make('link')->label('Link To Ads')
                // Tables\Columns\TextColumn::make('start_at')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('end_at')
                //     ->dateTime()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('credit')
                //     ->searchable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make()->label('')->tooltip('Edit'),
                DeleteAction::make()->label('')->tooltip('Delete'),
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
            'index' => Pages\ListAds::route('/'),
            'create' => Pages\CreateAds::route('/create'),
            'edit' => Pages\EditAds::route('/{record}/edit'),
        ];
    }    
}
