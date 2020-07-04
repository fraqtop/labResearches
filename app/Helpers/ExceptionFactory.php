<?php


namespace App\Helpers;

use Exception;

/**
 * Class ExceptionFactory
 *
 * @package App\Helpers
 *
 * @method static userNotFound()
 */
class ExceptionFactory
{
    private const EXCEPTION_TYPES = [
        'default' => ['code' => 500, 'message' => 'Внутренняя ошибка сервера'],
        'userNotFound' => ['code' => 404, 'message' => 'Пользователь не найден']
    ];

    public static function __callStatic($name, $arguments)
    {
        $exceptionType = static::EXCEPTION_TYPES[$name] ?? static::EXCEPTION_TYPES['default'];
        throw new Exception($exceptionType['message'], $exceptionType['code']);
    }
}