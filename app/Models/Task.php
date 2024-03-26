<?php

namespace App\Models;

use App\Enums\Priority;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
        'content',
        'priority',
        'group_id',
        'user_id',
    ];

    protected function casts(): array
    {
        return [
            'priority' => Priority::class,
        ];
    }
}
