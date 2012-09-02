<?php
class Acne_Util
{
    public static function isServiceProvider($value)
    {
        return !is_string($value) && is_callable($value);
    }
}
