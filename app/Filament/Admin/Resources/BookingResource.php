<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use App\Models\User;
use Filament\Tables;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\BookingResource\Pages;
use App\Filament\Admin\Resources\BookingResource\RelationManagers;
use Faker\Core\Color;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $label = 'Bookings';

    protected static ?string $pluralLabel = 'Booking';

    protected static ?string $navigationGroup = 'Administrations';
    protected static ?int $navigationSort = 1;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('driver_id')
                    ->label('Driver')
                    ->options(function () {
                        return \App\Models\Driver::where('status', 'available')
                            ->with('user') // Pastikan relasi user di-load
                            ->get()
                            ->pluck('user.name', 'id_driver'); // 'user.name' adalah nama user, 'id_driver' adalah ID driver
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\Select::make('vehicle_id')
                    ->label('Vehicle')
                    ->options(function () {
                        return \App\Models\Vehicle::where('status', 'available')
                            ->get()
                            ->pluck('name', 'id_vehicle'); // 'user.name' adalah nama user, 'id_driver' adalah ID driver
                    })
                    ->searchable()
                    ->required(),
                Forms\Components\TextInput::make('start_point')
                    ->label('Start Point')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('end_point')
                    ->label('End Point')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('distance_km')
                    ->label('Distance')
                    ->placeholder('Kilometers')
                    ->required()
                    ->numeric(),
                Forms\Components\DateTimePicker::make('start_date')
                    ->label('Start Date Time')
                    ->default(now('Asia/Jakarta'))
                    ->required(),
                Forms\Components\DateTimePicker::make('end_date')
                    ->label('End Date Time')
                    ->nullable(),
                Forms\Components\Select::make('approval_level_1')
                ->relationship('approvalLevel1', 'name')->preload()
                ->searchable()
                    ->label('Approval Level 1')
                    ->required(),
                Forms\Components\Select::make('approval_level_2')
                ->relationship('approvalLevel2', 'name')->preload()
                ->searchable()
                    ->label('Approval Level 2')
                    ->required(),
                Forms\Components\Select::make('status')
                ->options([
                    'pending' => 'pending',
                    'assigned' => 'assigned',
                    'completed' => 'completed'
                ])
                    ->default('pending'),
                Forms\Components\TextInput::make('notes')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
        ->columns([
            Tables\Columns\TextColumn::make('id_booking')
            ->label('ID'),
            // Requester Column - Fetches the name of the requester from the 'users' table
            Tables\Columns\TextColumn::make('requester_id')
                ->label('Requester')
                ->sortable()
                ->getStateUsing(function ($record) {
                    return \App\Models\User::find($record->requester_id)->name ?? 'N/A'; // Get the name of the requester
                }),
            Tables\Columns\TextColumn::make('vehicle.plate_number'),
            Tables\Columns\TextColumn::make('driver.user.name')
            ->label('Driver'),

            // Start Point Column
            Tables\Columns\TextColumn::make('start_point')
            ->label('Start Point')
                ->searchable(),

            // End Point Column
            Tables\Columns\TextColumn::make('end_point')
            ->label('End Point')
                ->searchable(),

            // Start Date Column
            Tables\Columns\TextColumn::make('start_date')
                ->dateTime()
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return \Carbon\Carbon::parse($state)->format('d-m-Y');
                }),

            // End Date Column
            Tables\Columns\TextColumn::make('end_date')
                ->dateTime()
                ->sortable()
                ->formatStateUsing(function ($state) {
                    return \Carbon\Carbon::parse($state)->format('d-m-Y');
                }),

            // Approval Status 1 Column
            Tables\Columns\BadgeColumn::make('approval_status_1')
            ->label('Approval 1')
            ->colors([
                'success' => 'approved',
                'warning' => 'pending',
            ]),

            // Approval Status 2 Column
            Tables\Columns\BadgeColumn::make('approval_status_2')
            ->label('Approval 2')
            ->colors([
                'success' => 'approved',
                'warning' => 'pending',
            ]),

            Tables\Columns\BadgeColumn::make('status')
            ->label('Status')
            ->colors([
                'success' => 'completed',
                'warning' => 'pending',
                'info' => 'assigned'
            ]),

            // Created At Column
            Tables\Columns\TextColumn::make('created_at')
                ->dateTime()
                ->sortable()
                ->toggleable(isToggledHiddenByDefault: true),

            // Updated At Column
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                ->label('Del'),
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
