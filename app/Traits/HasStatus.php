<?php
namespace App\Traits;

trait HasStatus{

    public static function statusValues()
    {
        return array_map(fn ($status) => $status->value, self::statusList); 
    }
}