<?php

namespace App\Enums;

enum GameState: string
{
    case WonX = 'x';

    case WonY = 'y';

    case Draw = 'draw';

    case Active = 'active';
}