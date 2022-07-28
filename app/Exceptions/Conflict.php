<?php

namespace App\Exceptions;

use Exception;

class Conflict extends Exception
{
    protected $message = 'Conflict.';
}