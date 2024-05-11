<?php

namespace App\Helper;

class FormatPaymentAmount
{
    public static function format($amount): string
    {
        return str_replace(['Rp. ', '.', ','], '', $amount);
    }
}
