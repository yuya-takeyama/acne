<?php
/**
 * This file is part of Acne.
 *
 * (c) Yuya Takeyama
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 * Util class for Acne.
 *
 * @author Yuya Takeyama
 */
class Acne_Util
{
    public static function isServiceProvider($value)
    {
        return !is_string($value) && is_callable($value);
    }
}
