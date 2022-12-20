<?php
declare(strict_types = 1);

namespace Blacky0892\LaravelHelper;

use Carbon\Carbon;

class Helper
{
    /**
     * Очистка номера телефона от посторонних символов для сохранения в базе
     * @param  string  $number
     * @return string
     */
    public function clearPhoneNumber(string $number): string
    {
        return str_replace(['+7', ' ', '(', ')', '-'], '', $number);
    }

    /**
     * Обрезка строки до нужной длины по словам
     * @param  string|null  $text  Исходная строка
     * @param  int  $maxChar  Максимальная длина
     * @param  string  $end  Символы после обрезки
     * @return string
     */
    function substrWords(?string $text, int $maxChar, string $end = '...'): string
    {
        if (is_null($text)) {
            return '';
        }
        // Удаление лишних пробелов
        $text = preg_replace('/\s+/', ' ', $text);
        if (mb_strlen($text) > $maxChar && $text !== '') {
            $words  = preg_split('/\s/', $text);
            $output = '';
            foreach ($words as $word) {
                $length = mb_strlen($output) + mb_strlen($word);
                if ($length > $maxChar) {
                    break;
                } else {
                    $output .= " ".$word;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }

        return $output;
    }

    function randomColorPart(): string
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }

    function randomColor(): string
    {
        return $this->randomColorPart().$this->randomColorPart().$this->randomColorPart();
    }

    function randomColorHex(): string
    {
        return '#'.$this->randomColor();
    }

    /**
     * Склонение в зависимости от числительного
     * @param  int  $number  - числительное
     * @param  array  $titles  - варианты склонений для 1,2,5
     * @return string
     */
    function declOfNum(int $number, array $titles): string
    {
        $cases       = [2, 0, 1, 1, 1, 2];
        $cacheNumber = $number % 100 > 4 && $number % 100 < 20 ? 2 : $cases[min($number % 10, 5)];

        return $titles[$cacheNumber] ?? $titles[$cacheNumber - 1];
    }

    /**
     * Поиск в массиве по определённому значению
     * @param array $array - массив
     * @param mixed $key - ключ, по которому происходит поиск
     * @param mixed $val
     * @return string|null
     */
    function searchForId(array $array, $key, $val)
    {
        foreach ($array as $k => $v) {
            if(gettype($v) === 'object'){
                if ($v->$key === $val) {
                    return (string) $k;
                }
            }
            else{
                if ($v[$key] === $val) {
                    return (string) $k;
                }
            }
        }
        return null;
    }

    /**
     * Поиск в массиве по определенному значению. Возвращает значение из соответствующего ключа
     * @param  array  $array
     * @param mixed $key - ключ, по которому происходит поиск
     * @param mixed $val - значение для поиска
     * @param mixed $returnKey - ключ для возврата значения
     * @return mixed
     */
    function searchById(array $array, $key, $val, $returnKey)
    {
        return $array[$this->searchForId($array, $key, $val)][$returnKey];
    }

    /**
     * Многобайтовый переворот строки
     * @param $str
     * @return string
     */
    function mbStrrev(string $str): string
    {
        $r = '';
        for ($i = mb_strlen($str); $i >= 0; $i--) {
            $r .= mb_substr($str, $i, 1);
        }

        return $r;
    }

    /**
     * Первая заглавная буква для многобайтовых кодировок
     * @param $str
     * @return string
     */
    function mbUcfirst(string $str): string
    {
        $fc = mb_strtoupper(mb_substr($str, 0, 1));

        return $fc.mb_strtolower(mb_substr($str, 1));
    }

    /**
     * Получение информации о файле (файлах)
     * @param $files
     * @return array
     */
    function getFileInfo($files): array
    {
        $info = [];
        if (is_array($files)) {
            foreach ($files as $file) {
                $info[] = array_merge(['file' => $file], pathinfo($file));
            }
        } else {
            $info = array_merge(['file' => $files], pathinfo($files));
        }

        return $info;
    }

    /**
     * Проверка, что введённая информация является корректным номером телефона
     * @param  string|null  $phoneNumber
     * @return bool
     */
    function checkPhone(?string $phoneNumber): bool
    {
        return !is_null($phoneNumber) && preg_match("/^\(?[489][0-9]{2}\)?[\s\-]?[0-9]{3}[\s\-]?[0-9]{2}[\s\-]?[0-9]{2}$/", $phoneNumber);
    }

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
    function formatPhoneNumber(?string $phoneNumber, string $country = '+7'): ?string
    {
        if ($phoneNumber) {
            $phoneNumbers = explode(',', $phoneNumber);
            $result       = '';
            foreach ($phoneNumbers as $key => $number) {
                $number = clear_phone_number($number);
                if (strlen($number) > 10) {
                    $countryCode = substr($number, 0, strlen($number) - 10);
                    $areaCode    = substr($number, -10, 3);
                    $nextThree   = substr($number, -7, 3);
                    $lastFour    = substr($number, -4, 4);

                    $number = '+'.$countryCode.'('.$areaCode.')'
                        .$nextThree.'-'.$lastFour;
                }
                elseif (strlen($number) === 10) {
                    $areaCode  = substr($number, 0, 3);
                    $nextThree = substr($number, 3, 3);
                    $lastFour  = substr($number, 6, 4);

                    $number = $country . '('.$areaCode.') '.$nextThree.'-'.$lastFour;
                }
                elseif (strlen($number) == 7) {
                    $nextThree = substr($number, 0, 3);
                    $lastFour  = substr($number, 3, 4);

                    $number = $nextThree.'-'.$lastFour;
                }

                $result .= $number;
                if ($key != count($phoneNumbers) - 1) {
                    $result .= ', ';
                }
            }
        } else {
            $result = null;
        }

        return $result;
    }

    /**
     * Генерация случайного пароля
     * @param  int  $len  - Длина пароля
     * @param  int|null  $maxCharsCount - Максимальное количество спецсимволов
     * @return string
     */
    function randomPassword(int $len = 8, ?int $maxCharsCount = 2): string
    {
        if($len < 8) $len = 8;

        // Наборы символов
        $sets = [];
        // Заглавные буквы
        $sets[0] = 'ABCDEFGHJKLMNPQRSTUVWXYZ';
        // Строчные буквы
        $sets[1] = 'abcdefghjkmnpqrstuvwxyz';
        // Цифры
        $sets[2] = '23456789';
        // Спец символы
        $sets[3]  = '!@#$%?';

        $password = '';

        // Первые 4 символа - по одному случайному из каждого набора
        foreach ($sets as $set) {
            $password .= $set[array_rand(str_split($set))];
        }

        $chars = 1;

        // Оставшиеся символы случайные из всех наборов
        while(strlen($password) < $len) {
            $key = array_rand($sets);
            if($key === 3 && $chars >= $maxCharsCount){
                continue;
            }
            else{
                // Выбираем случайный набор
                $randomSet = $sets[$key];
                if($key === 3) $chars++;
            }


            // Берем случайный символ из этого набора
            $password .= $randomSet[array_rand(str_split($randomSet))];
        }

        // Перемешиваем строку
        return str_shuffle($password);
    }

    /**
     * Получение учебного года
     *
     * @param  Carbon  $date     Дата, для которой надо узнать
     *                                      учебный год
     * @param  Carbon|null $firstSep Начало учебного года
     *
     * @return null|string
     */
    public function getSchoolYear(Carbon $date, Carbon $firstSep = null): ?string
    {
        $year = $date->year; // год даты
        // Если не указано начало учебного года, считаем начало как 1 сентября этого года
        if(is_null($firstSep)){
            $firstSep = Carbon::create($year, '09', '01');
        }
        if($firstSep < Carbon::create('2010', '01', '01')){
            return null;
        }

        // Если текущая дата > начала учебного года, возвращаем текущий год + следующий
        if($date >= $firstSep){
            $schoolYear = $firstSep->year . '/' . ($firstSep->year + 1);
        } // Если текущая дата < начала учебного года, вызываем функцию еще раз, уменьшаем год на 1
        else{
            return $this->getSchoolYear($date, $firstSep->subYear());
        }

        return $schoolYear;
    }

    /**
     * Случайное число с пропусками
     * @param $from
     * @param $to
     * @param  array  $excluded Числа, исключаемые из случайных
     * @return int
     */
    function randomNumber($from, $to, array $excluded = []): int
    {
        $func = function_exists('random_int') ? 'random_int' : 'mt_rand';

        do {
            $number = $func($from, $to);
        } while (in_array($number, $excluded, true));

        return $number;
    }
}