<?php

namespace App\Filament\Resources\Faqs\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class FaqInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('question'),
                TextEntry::make('answer')
                    ->html()
                    ->prose()
                    ->columnSpanFull(),
            ]);
    }
}
