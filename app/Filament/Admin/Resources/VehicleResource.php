<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Vehicle;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\VehicleResource\Pages;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use App\Filament\Admin\Resources\VehicleResource\RelationManagers;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;

    protected static ?string $navigationIcon = 'heroicon-o-truck';


    protected static ?string $label = 'Vehicle';

    protected static ?string $pluralLabel = 'Vehicle';

    protected static ?string $navigationGroup = 'Administrations';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('plate_number')
                    ->unique()
                    ->required()
                    ->maxLength(255),
                Forms\Components\Select::make('type')
                    ->options([
                        'Angkutan Barang' => 'Angkutan Barang',
                        'Angkutan Orang' => 'Angkutan Orang',
                    ])
                    ->default('Angkutan Barang')
                    ->required(),
                Forms\Components\TextInput::make('fuel_consumption')
                    ->label('Fuel Km/Liter')
                    ->placeholder('example : 12 ')
                    ->required()
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'available' => 'Available',
                        'used' => 'Used',
                        'maintenance' => 'Maintenance'
                    ])
                    ->default('available')
                    ->required(),
                Forms\Components\Select::make('ownership')
                    ->options([
                        'Owned' => 'Owned',
                        'Rental' => 'Rental'
                    ])
                    ->default('Owned')
                    ->required(),
                Forms\Components\FileUpload::make('photo_path')
                    ->nullable()
                    ->label('Photo')
                    ->directory('vehicles')  // Tetap tentukan folder tujuan file di public
                    ->getUploadedFileNameForStorageUsing(fn (TemporaryUploadedFile $file) => $file->getClientOriginalName())  // Nama file tanpa path
                    ->visibility('public'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_vehicle')
                ->label('ID'),
                Tables\Columns\ImageColumn::make('photo_path')
                ->label('Image')
                ->url(fn($record) => url('storage/' . $record->photo_path)) // Menggunakan url()
                ,
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('plate_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('type'),
                Tables\Columns\TextColumn::make('fuel_consumption')
                ->label('Fuel')
                ->sortable()
                ->formatStateUsing(fn ($state) => $state ? "{$state} km/liter" : '-'),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'available', // Warna hijau untuk status 'completed'
                    'warning' => 'maintenance',   // Warna kuning untuk status 'pending'
                    'danger' => 'used',   // Warna merah untuk status 'rejected'
                ]),
                Tables\Columns\BadgeColumn::make('ownership')
                ->label('Ownership')
                ->colors([
                    'primary' => 'owned', // Warna hijau untuk status 'completed'
                    'danger' => 'rented',   // Warna merah untuk status 'rejected'
                ]),
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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
