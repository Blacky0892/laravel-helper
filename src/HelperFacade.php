<?php
declare(strict_types = 1);

namespace Blacky0892\LaravelHelper;

use Illuminate\Support\Facades\Facade;

class HelperFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'helper';
    }
}