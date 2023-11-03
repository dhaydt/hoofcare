<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ItemResource\Pages;
use App\Filament\Resources\ItemResource\RelationManagers;
use App\Models\Category;
use App\Models\Item;
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

class ItemResource extends Resource
{
    protected static ?string $model = Item::class;

    protected static ?string $navigationIcon = 'heroicon-o-chat-bubble-bottom-center-text';

    public static function form(Form $form): Form
    {
        $categories = Category::get();
        $newCat = [];

        foreach ($categories as $c) {
            $newCat[$c['id']] = $c['name'];
        }

        return $form
            ->schema([
                Forms\Components\Select::make('category_id')
                    ->label('Category')
                    ->placeholder('Select category')
                    ->options($newCat)
                    ->required(),
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\Textarea::make('description')
                    ->maxLength(65535)
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('pic1')
                    ->label('Picture 1')
                    ->directory('picture')
                    ->columnSpanFull(),
                Forms\Components\FileUpload::make('pic2')
                    ->label('Picture 2')
                    ->directory('picture'),
                Forms\Components\FileUpload::make('pic3')
                    ->label('Picture 3')
                    ->directory('picture'),
                Forms\Components\FileUpload::make('pic4')
                    ->label('Picture 4')
                    ->directory('picture'),
                Forms\Components\FileUpload::make('pic5')
                    ->label('Picture 5')
                    ->directory('picture'),
                Forms\Components\FileUpload::make('file_link1')
                    ->label('File link 1')
                    ->directory('file'),
                Forms\Components\FileUpload::make('file_link2')
                    ->label('File link 2')
                    ->directory('file'),
                Forms\Components\Textarea::make('online_link')
                    ->label('Online Link')
                    ->maxLength(65535),
                Forms\Components\Textarea::make('credit')
                    ->maxLength(65535),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('index')
                ->label('No')
                ->rowIndex(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('category.name')
                    ->label('Category')
                    ->searchable(),
                Tables\Columns\ImageColumn::make('pic1')->height(80)
                    ->label('Picture 1')->height(80),
                Tables\Columns\ImageColumn::make('pic2')
                    ->label('Picture 2')->height(80),
                Tables\Columns\ImageColumn::make('pic3')
                    ->label('Picture 3')->height(80),
                Tables\Columns\ImageColumn::make('pic4')
                    ->label('Picture 4')->height(80),
                Tables\Columns\ImageColumn::make('pic5')
                    ->label('Picture 5')->height(80),
                Tables\Columns\TextColumn::make('file_link1')
                    ->label('File link 1')
                    ->searchable(),
                Tables\Columns\TextColumn::make('file_link2')
                    ->label('File link 2')
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
                Tables\Actions\EditAction::make()->label('')->tooltip('Edit'),
                DeleteAction::make()->label('')->tooltip('Delete'),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListItems::route('/'),
            'create' => Pages\CreateItem::route('/create'),
            'edit' => Pages\EditItem::route('/{record}/edit'),
        ];
    }
}
