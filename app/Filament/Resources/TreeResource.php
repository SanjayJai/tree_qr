<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TreeResource\Pages;
use App\Models\Tree;
use Filament\Forms;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class TreeResource extends Resource
{
    protected static ?string $model = Tree::class;

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                TextInput::make('common_name')
                    ->required()
                    ->maxLength(30),
                TextInput::make('family_name')
                    ->required()
                    ->maxLength(30),
                TextInput::make('species_name')
                    ->required()
                    ->maxLength(30),
                TextInput::make('location')
                    ->required()
                    ->maxLength(30),
                TextInput::make('tree_uses')
                    ->required()
                    ->maxLength(200),
                TextInput::make('distribution')
                    ->required()
                    ->maxLength(100),
                TextInput::make('other_information')
                    ->required()
                    ->maxLength(200),
                FileUpload::make('tree_image')
                    ->image()
                    ->directory('tree_images')
                    ->nullable(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                TextColumn::make('common_name')->sortable(),
                TextColumn::make('family_name')->sortable(),
                TextColumn::make('species_name')->sortable(),
                ImageColumn::make('tree_image')
                    ->getStateUsing(fn ($record) => $record->tree_image ? asset('storage/' . $record->tree_image) : null)
                    ->label('Tree Image'),
                ImageColumn::make('qr_code')
                    ->getStateUsing(fn ($record) => $record->qr_code ? asset('storage/' . $record->qr_code) : null)
                    ->label('QR Code'),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\Action::make('download_qr_code')
                    ->label('Download QR Code')
                    
                    ->url(fn ($record) => route('tree.qr.download', $record->slug))
                    ->openUrlInNewTab()
            ]);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTrees::route('/'),
            'create' => Pages\CreateTree::route('/create'),
            'edit' => Pages\EditTree::route('/{record}/edit'),
        ];
    }

    // Hook into the "saved" event of the Tree model to regenerate the QR code
    public static function booted(): void
    {
        parent::booted();

        static::saved(function (Tree $tree) {
            // If the slug or common_name is dirty, regenerate the QR code
            if ($tree->isDirty('slug') || $tree->isDirty('common_name')) {
                $qrCodePath = 'qrcodes/tree_' . uniqid() . '.png';
                Storage::disk('public')->put($qrCodePath, QrCode::format('png')->size(200)->generate(route('tree.show', $tree->slug)));
                $tree->qr_code = $qrCodePath;
                $tree->save(); // Ensure QR code is saved after generation
            }
        });
    }
}
