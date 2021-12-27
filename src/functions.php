<?php
declare(strict_types = 1);

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
        if(is_null($text)) return '';
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
                    $output .= " " . $word;
                }
            }
            $output .= $end;
        } else {
            $output = $text;
        }

        return $output;
    }
}

if (!function_exists('random_color_part')) {
    function random_color_part(): string
    {
        return str_pad(dechex(mt_rand(0, 255)), 2, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('random_color')) {
    function random_color(): string
    {
        return random_color_part() . random_color_part() . random_color_part();
    }
}

if (!function_exists('random_color_hex')) {
    function random_color_hex(): string
    {
        return '#' . random_color();
    }
}

if(!function_exists('decl_of_num')){
    function decl_of_num(int $number, array $titles) : string
    {
        $cases = [2, 0, 1, 1, 2];
        $cacheNumber = $number % 100 > 4 && $number % 100 < 20 ? 2 : $cases[min($number % 10, 5)];
        return $titles[$cacheNumber];
    }
}


if(!function_exists('search_for_id'))
{
    function search_for_id($array, $key, $val) {
        foreach ($array as $k => $v) {
            if ($v[$key] === $val) {
                return $k;
            }
        }
        return null;
    }
}
