<?php

namespace App\Containers\Sample\Enums;

enum SampleType: int
{
    case ADMINISTRATOR = 0;
    case SUPER_ADMINISTRATOR = 1;
    case MODERATOR = 2;
}
