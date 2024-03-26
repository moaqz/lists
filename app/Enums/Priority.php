<?php

namespace App\Enums;

enum Priority: int
{
    case HIGH = 3;
    case MEDIUM = 2;
    case LOW = 1;
    case NONE = 0;
}
