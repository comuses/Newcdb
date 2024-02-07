<?php

namespace App\Filament\Resources;

use App\Models\Case1;
use Filament\{Tables, Forms};
use Filament\Resources\{Form, Table, Resource};
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\Case1Resource\Pages;

class Case1Resource extends Resource
{
    protected static ?string $model = Case1::class;

    protected static ?string $navigationIcon = 'heroicon-o-collection';

    protected static ?string $recordTitleAttribute = 'partyID';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('partyID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Party Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('Action')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Action')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('courtID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Court Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('judgeID')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Judge Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('start_date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Start Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('end_date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('End Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('caseTyep')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Case Tyep')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('caseStatus')
                        ->rules(['max:255', 'string'])
                        ->required()
                        ->placeholder('Case Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->poll('60s')
            ->columns([
                Tables\Columns\TextColumn::make('partyID')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('Action')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('courtID')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('judgeID')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('start_date')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('end_date')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('caseTyep')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('caseStatus')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
            ])
            ->filters([DateRangeFilter::make('created_at')]);
    }

    public static function getRelations(): array
    {
        return [
            Case1Resource\RelationManagers\PartiesRelationManager::class,
            Case1Resource\RelationManagers\CourtsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCase1s::route('/'),
            'create' => Pages\CreateCase1::route('/create'),
            'view' => Pages\ViewCase1::route('/{record}'),
            'edit' => Pages\EditCase1::route('/{record}/edit'),
        ];
    }
}
