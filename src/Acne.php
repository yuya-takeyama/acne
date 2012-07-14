<?php
require_once dirname(__FILE__) . '/Acne/Container.php';
require_once dirname(__FILE__) . '/Acne/SharedServiceProvider.php';

/**
 * Acne.
 *
 * Simple DI Container for PHP < 5.2
 *
 * @author Yuya Takeyama
 */
class Acne
{
    const VERSION = '0.0.0';

    public static function isServiceProvider($value)
    {
        return !is_string($value) && is_callable($value);
    }
}
