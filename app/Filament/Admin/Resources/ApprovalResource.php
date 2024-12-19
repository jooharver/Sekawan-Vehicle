<?php

namespace App\Filament\Admin\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Approval;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Admin\Resources\ApprovalResource\Pages;
use App\Filament\Admin\Resources\ApprovalResource\RelationManagers;

class ApprovalResource extends Resource
{
    protected static ?string $model = Approval::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $label = 'Approval';

    protected static ?string $pluralLabel = 'Approvals';

    protected static ?string $navigationGroup = 'Administrations';

        // Menambahkan badge untuk menampilkan total data
        public static function getNavigationBadge(): ?string
        {
            $userId = Auth::id(); // Mendapatkan ID user yang sedang login

            // Hanya menghitung data sesuai approver_id dan status 'pending'
            return (string) Approval::where('approver_id', $userId)
                ->where('status', 'pending')
                ->count();
        }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('status')
                    ->options([
                        'pending' => 'Pending',
                        'approved' => 'Approved',
                        'rejected' => 'Rejected'
                    ]),
                Forms\Components\Textarea::make('comments')
                    ->nullable(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->query(Approval::where('approver_id', auth()->user()->id))
            ->columns([
                Tables\Columns\TextColumn::make('id_approval')
                ->label('ID'),
                Tables\Columns\TextColumn::make('booking_id')
                ->label('Booking ID')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created At')
                    ->formatStateUsing(fn ($state) => $state ? date('d-m-Y' . ', '. 'H:i' , strtotime($state)) . ' WIB' : '-')
                    ->sortable(),
                Tables\Columns\BadgeColumn::make('status')
                ->colors([
                    'warning' => 'pending',
                    'primary' => 'approved',
                    'danger' => 'rejected'
                ]),
                Tables\Columns\TextColumn::make('updated_at')
                    ->label('Created At')
                    ->formatStateUsing(fn ($state) => $state ? date('d-m-Y H:i', strtotime($state)) . ' WIB' : '-')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListApprovals::route('/'),
            'create' => Pages\CreateApproval::route('/create'),
            'edit' => Pages\EditApproval::route('/{record}/edit'),
        ];
    }
}
