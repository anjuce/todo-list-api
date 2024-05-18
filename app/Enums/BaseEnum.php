<?php

namespace App\Enums;

/**
 * Class BaseEnum
 * @package App\Enum
 */
class BaseEnum
{
    /**
     * @param $value
     * @return false|int|string
     */
    public static function getKey($value)
    {
        $constants = self::getConstants();
        return array_search($value, $constants);
    }

    /**
     * @return array
     */
    private static function getConstants(): array
    {
        $reflection = new \ReflectionClass(__CLASS__);
        return $reflection->getConstants();
    }
}
