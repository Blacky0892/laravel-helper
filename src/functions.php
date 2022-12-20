<?php
/** @noinspection PhpDynamicAsStaticMethodCallInspection */
declare(strict_types = 1);

use Blacky0892\LaravelHelper\Facades\LaravelHelper;
use Carbon\Carbon;

if (!function_exists('format_phone')) {
    /**
     * Форматирование номера телефона для сохранения в БД. Удаление пробелов и кода страны
     * @param string|null $phone
     * @return string
     */
    function format_phone(?string $phone): string
    {
        $phone = str_replace(' ', '', $phone);

        return str_replace('+7', '', $phone);
    }
}

if (!function_exists('substr_words')) {
    /**
     * Обрезка строки до нужной длины по словам
     * @param  string|null  $text  Исходная строка
     * @param  int  $maxChar  Максимальная длина
     * @param  string  $end  Символы после обрезки
     * @return string
     */
    function substr_words(?string $text, int $maxChar, string $end = '...'): string
    {
        return LaravelHelper::substrWords($text, $maxChar, $end);
    }
}

if (!function_exists('random_color_part')) {
    function random_color_part(): string
    {
        return LaravelHelper::randomColorPart();
    }
}

if (!function_exists('random_color')) {
    function random_color(): string
    {
        return LaravelHelper::randomColor();
    }
}

if (!function_exists('random_color_hex')) {
    function random_color_hex(): string
    {
        return LaravelHelper::randomColorHex();
    }
}

if(!function_exists('decl_of_num')){
    /**
     * Склонение в зависимости от числительного
     * @param  int  $number - числительное
     * @param  array  $titles - варианты склонений для 1,2,5
     * @return string
     */
    function decl_of_num(int $number, array $titles) : string
    {
        return LaravelHelper::declOfNum($number, $titles);
    }
}


if(!function_exists('search_for_id'))
{
    /**
     * Поиск подмассива в массиве по определённому значению
     * @param array $array - массив
     * @param mixed $key - ключ, по которому происходит поиск
     * @param mixed $val
     * @return mixed
     */
    function search_for_id(array $array, string $key, $val)
    {
        return LaravelHelper::searchForId($array, $key, $val);
    }
}

if(!function_exists('search_by_id'))
{
    /**
     * Поиск в массиве по определенному значению. Возвращает значение из соответствующего ключа
     * @param  array  $array
     * @param mixed $key - ключ, по которому происходит поиск
     * @param mixed $val - значение для поиска
     * @param mixed $returnKey - ключ для возврата значения
     * @return mixed
     */
    function search_by_id(array $array, $key, $val, $returnKey)
    {
        return LaravelHelper::searchById($array, $key, $val, $returnKey);
    }
}

if (!function_exists('mb_strrev')) {
    /**
     * Многобайтовый переворот строки
     * @param  string  $str
     * @return string
     */
    function mb_strrev(string $str): string
    {
        return LaravelHelper::mbStrrev($str);
    }
}

if (!function_exists('mb_ucfirst')) {
    /**
     * Первая заглавная буква для многобайтовых кодировок
     * @param  string  $str
     * @return string
     */
    function mb_ucfirst(string $str): string
    {
        return LaravelHelper::mbUcfirst($str);
    }
}

if (!function_exists('getFileInfo')) {
    function getFileInfo($files): array
    {
        return LaravelHelper::getFileInfo($files);
    }
}

if(!function_exists('clear_phone_number')){
    /**
     * Очистка номера телефона от посторонних символов для сохранения в базе
     * @param  string  $phoneNumber
     * @return string
     */
    function clear_phone_number(string $phoneNumber): string
    {
        return LaravelHelper::clearPhoneNumber($phoneNumber);
    }
}

if(!function_exists('check_phone')){
    /**
     * Проверка, что введённая информация является корректным номером телефона
     * @param  string|null  $phoneNumber
     * @return bool
     */
    function check_phone(?string $phoneNumber): bool
    {
        return LaravelHelper::checkPhone($phoneNumber);
    }
}

if (!function_exists('format_phone_number')) {
    /**
     * Форматирование телефонного номера для вывода на экран
     * Если цифр в номере больше 10, формат: +X(XXX)XXX-XXXX
     * Если цифр ровно 10, формат: (XXX)XXX-XXXX
     * Если цифр ровно 7, формат: ХХХ-ХХХХ
     * В других случаях форматирование не производится
     *
     * @param  string|null  $phoneNumber  номер телефона
     *
     * @return string
     */
    function format_phone_number(?string $phoneNumber, string $country = '+7'): ?string
    {
        return LaravelHelper::formatPhoneNumber($phoneNumber, $country);
    }
}

if (!function_exists('randomPassword')) {
    /**
     * Генерация случайного пароля
     * @param  int  $len  - Длина пароля
     * @param  int|null  $maxCharsCount - Максимальное количество спецсимволов
     * @return string
     */
    function randomPassword(int $len = 8, ?int $maxCharsCount = 2)
    {
        return LaravelHelper::randomPassword($len, $maxCharsCount);
    }
}

if (!function_exists('getSchoolYear')) {
    /**
     * Получение учебного года
     *
     * @param  Carbon  $date     Дата, для которой надо узнать
     *                                      учебный год
     * @param  Carbon|null $firstSep Начало учебного года
     *
     * @return null|string
     */
    function getSchoolYear(Carbon $date, Carbon $firstSep = null): ?string
    {
        return LaravelHelper::getSchoolYear($date, $firstSep);
    }
}

if (!function_exists('randomNumber')) {
    /**
     * Случайное число с пропусками
     * @param $from
     * @param $to
     * @param  array  $excluded Числа, исключаемые из случайных
     * @return int
     */
    function randomNumber($from, $to, array $excluded = []): int
    {
        return LaravelHelper::randomNumber($from, $to, $excluded);
    }
}