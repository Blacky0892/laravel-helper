<?php
declare(strict_types = 1);

namespace Blacky0892\LaravelHelper\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @mixin \Blacky0892\LaravelHelper\Helper
 *
 */
class LaravelHelper extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'laravel-helper';
    }
}