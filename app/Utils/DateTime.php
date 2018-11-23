<?php
namespace App\Utils;

class DateTime {
    public static function now() {
        return date("Y-m-d H:i:s");
    }
}