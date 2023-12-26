<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'name',
        'piece_quantity',
        'simple_piece_quantity',
        'difficult_piece_quantity',
        'simple_piece_value',
        'difficult_piece_value',
        'additional_simple_piece_value',
        'additional_difficult_piece_value',
        'is_active'
    ];

    protected function isActive(): Attribute
    {
        return Attribute::make(
            set: fn(string $value) => $value == 'on' ? 1 : 0
        );
    }

    protected function simplePieceValue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 2, ',', ''),
            set: fn(string $value) => number_format(
                (float)str_replace(',', '.', str_replace('.', '', $value)),
                2,
                '.',
                ''
            )
        );
    }

    protected function difficultPieceValue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 2, ',', ''),
            set: fn(string $value) => number_format(
                (float)str_replace(',', '.', str_replace('.', '', $value)),
                2,
                '.',
                ''
            )
        );
    }

    protected function additionalSimplePieceValue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 2, ',', ''),
            set: fn(string $value) => number_format(
                (float)str_replace(',', '.', str_replace('.', '', $value)),
                2,
                '.',
                ''
            )
        );
    }

    protected function additionalDifficultPieceValue(): Attribute
    {
        return Attribute::make(
            get: fn($value) => number_format($value, 2, ',', ''),
            set: fn(string $value) => number_format(
                (float)str_replace(',', '.', str_replace('.', '', $value)),
                2,
                '.',
                ''
            )
        );
    }
}
