<?php

namespace App\Enums;

enum Color: string
{
    case DEFAULT = 'default';
    case GRAY = 'gray';
    case BROWN = 'brown';
    case YELLOW = 'yellow';
    case ORANGE = 'orange';
    case GREEN = 'green';
    case BLUE = 'blue';
    case PURPLE = 'purple';
    case PINK = 'pink';
    case RED = 'red';

    public static function toArray(): array
    {
        return array_column(self::cases(), 'value');
    }
}
