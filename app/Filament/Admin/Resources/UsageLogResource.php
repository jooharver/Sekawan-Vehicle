<?php

namespace App\Filament\Admin\Resources;

use App\Filament\Admin\Resources\UsageLogResource\Pages;
use App\Filament\Admin\Resources\UsageLogResource\RelationManagers;
use App\Models\UsageLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class UsageLogResource extends Resource
{
    protected static ?string $model = UsageLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';


    protected static ?string $label = 'Report';

    protected static ?string $pluralLabel = 'Report';

    protected static ?string $navigationGroup = 'Administrations';
    protected static ?int $navigationSort = 5;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('vehicle_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('booking_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('start_point')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('end_point')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('start_date')
                    ->required(),
                Forms\Components\DatePicker::make('end_date')
                    ->required(),
                Forms\Components\TextInput::make('distance_km')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('fuel_used')
                    ->required()
                    ->numeric(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id_usagelog')
                ->label('ID')
                ->numeric()
                ->sortable(),
                Tables\Columns\TextColumn::make('booking_id')
                ->label('Booking ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.name')
                ->label('Vehicle')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('vehicle.plate_number')
                ->label('Plate Number')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_point')
                    ->searchable(),
                Tables\Columns\TextColumn::make('end_point')
                    ->searchable(),
                Tables\Columns\TextColumn::make('start_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('distance_km')
                ->label('Distance')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('fuel_used')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->headerActions([
                Tables\Actions\Action::make('Export Excel')
                ->label('Export Excel')
                ->url(route('export-usage'))
                ->icon('heroicon-o-arrow-down-tray')
                ->openUrlInNewTab(),

                Tables\Actions\Action::make('Export PDF')
                    ->label('Export PDF')
                    ->url(route('export-usagelog')) // Perbaiki nama route di sini
                    ->icon('heroicon-o-arrow-up-tray')
                    ->openUrlInNewTab(),
            ])

            ->filters([
                //
            ])
            ->actions([
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
            'index' => Pages\ListUsageLogs::route('/'),
            'create' => Pages\CreateUsageLog::route('/create'),
            'edit' => Pages\EditUsageLog::route('/{record}/edit'),
        ];
    }
}
