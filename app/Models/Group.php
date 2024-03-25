<?php

namespace App\Models;

use App\Enums\Color;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'title',
        'user_id',
        'color',
    ];

    protected function casts(): array
    {
        return [
            'color' => Color::class,
        ];
    }
}
