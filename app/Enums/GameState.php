<?php

namespace App\Enums;

enum GameState: string
{
    case WonX = 'x';

    case WonO = 'o';

    case Draw = 'draw';

    case Active = 'active';
}