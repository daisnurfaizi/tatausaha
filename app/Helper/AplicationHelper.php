<?php

namespace App\Helper;

use App\Models\Aplication;

class AplicationHelper
{
    public static function getAplication()
    {
        return Aplication::first();
    }
}
