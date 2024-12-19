<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\MaintenanceResource\Pages;
use App\Filament\Admin\Resources\MaintenanceResource\RelationManagers;
use App\Models\Maintenance;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class MaintenanceResource extends Resource
{
    protected static ?string $model = Maintenance::class;

    protected static ?string $navigationIcon = 'heroicon-o-calendar-date-range';

    protected static ?string $label = 'Maintenance';

    protected static ?string $pluralLabel = 'Maintenance';

    protected static ?string $navigationGroup = 'Administrations';
    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('vehicle_id')
                ->relationship('vehicle', 'name')->preload()
                ->searchable()
                ->required(),
                Forms\Components\Textarea::make('description')
                    ->nullable(),
                Forms\Components\DatePicker::make('scheduled_date')
                    ->required(),
                Forms\Components\DatePicker::make('completion_date')
                    ->nullable(),
                Forms\Components\TextInput::make('cost')
                    ->placeholder('example : 300000')
                    ->nullable()
                    ->numeric(),
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'maintenance' => 'Maintenance',
                        'completed' => 'Completed'
                    ])
                    ->required()
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_maintenance')
                ->label('ID'),
                Tables\Columns\TextColumn::make('vehicle.name')
                    ->label('Name')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.plate_number')
                    ->label('Plate Number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('scheduled_date')
                    ->label('Scheduled Date')
                    ->dateTime()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return \Carbon\Carbon::parse($state)->format('d-m-Y');
                    }),
                Tables\Columns\TextColumn::make('completion_date')
                    ->label('Competion Date')
                    ->dateTime()
                    ->sortable()
                    ->formatStateUsing(function ($state) {
                        return \Carbon\Carbon::parse($state)->format('d-m-Y');
                    }),
                Tables\Columns\TextColumn::make('cost')
                    ->money()
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                ->label('Status')
                ->colors([
                    'success' => 'completed',
                    'warning' => 'pending',
                    'danger' => 'maintenance',
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
                Tables\Actions\ViewAction::make()
                ->label('Detail'),
                Tables\Actions\DeleteAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListMaintenances::route('/'),
            'create' => Pages\CreateMaintenance::route('/create'),
            'edit' => Pages\EditMaintenance::route('/{record}/edit'),
        ];
    }
}
