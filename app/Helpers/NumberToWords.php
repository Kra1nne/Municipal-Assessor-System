<?php

if (!function_exists('convertNumberToWords')) {
    function convertNumberToWords($number)
    {
        // Make sure it’s numeric (float or int)
        if (!is_numeric($number)) {
            return '';
        }

        // Round to two decimal places
        $number = round($number, 2);

        $integerPart = floor($number);
        $decimalPart = (int) round(($number - $integerPart) * 100);

        $hyphen      = '-';
        $conjunction = ' and ';
        $separator   = ', ';
        $dictionary  = [
            0                   => 'zero',
            1                   => 'one',
            2                   => 'two',
            3                   => 'three',
            4                   => 'four',
            5                   => 'five',
            6                   => 'six',
            7                   => 'seven',
            8                   => 'eight',
            9                   => 'nine',
            10                  => 'ten',
            11                  => 'eleven',
            12                  => 'twelve',
            13                  => 'thirteen',
            14                  => 'fourteen',
            15                  => 'fifteen',
            16                  => 'sixteen',
            17                  => 'seventeen',
            18                  => 'eighteen',
            19                  => 'nineteen',
            20                  => 'twenty',
            30                  => 'thirty',
            40                  => 'forty',
            50                  => 'fifty',
            60                  => 'sixty',
            70                  => 'seventy',
            80                  => 'eighty',
            90                  => 'ninety',
            100                 => 'hundred',
            1000                => 'thousand',
            1000000             => 'million',
            1000000000          => 'billion',
        ];

        $string = '';

        if ($integerPart === 0) {
            $string = $dictionary[0];
        } else {
            $string = convertIntegerToWords($integerPart, $dictionary, $hyphen, $conjunction, $separator);
        }

        $result = ucfirst($string) . ' Pesos';

        if ($decimalPart > 0) {
            // add centavos
            $decimalWords = convertIntegerToWords($decimalPart, $dictionary, $hyphen, $conjunction, $separator);
            $result .= ' and ' . $decimalWords . ' Centavos';
        }

        return $result;
    }
}

/**
 * Helper to convert an integer to words (handles thousands, millions, etc.)
 */
if (!function_exists('convertIntegerToWords')) {
    function convertIntegerToWords($number, $dictionary, $hyphen, $conjunction, $separator)
    {
        if ($number < 21) {
            return $dictionary[$number];
        }
        if ($number < 100) {
            $tens = ((int)($number / 10)) * 10;
            $units = $number % 10;
            $str = $dictionary[$tens];
            if ($units) {
                $str .= $hyphen . $dictionary[$units];
            }
            return $str;
        }
        if ($number < 1000) {
            $hundreds = (int)($number / 100);
            $remainder = $number % 100;
            $str = $dictionary[$hundreds] . ' ' . $dictionary[100];
            if ($remainder) {
                $str .= $conjunction . convertIntegerToWords($remainder, $dictionary, $hyphen, $conjunction, $separator);
            }
            return $str;
        }

        // for numbers >= 1000
        $baseUnit = pow(1000, floor(log($number, 1000)));
        $numBaseUnits = (int) ($number / $baseUnit);
        $remainder = $number % $baseUnit;

        $str = convertIntegerToWords($numBaseUnits, $dictionary, $hyphen, $conjunction, $separator)
             . ' ' . $dictionary[$baseUnit];
        if ($remainder) {
            $str .= $remainder < 100 ? $conjunction : $separator;
            $str .= convertIntegerToWords($remainder, $dictionary, $hyphen, $conjunction, $separator);
        }
        return $str;
    }
}
