<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Url;

/**
 * Class Url
 *
 * @package Branches\Url
 */
class Url
{
    /** @var string */
    protected $url;

    public function __construct($url)
    {
        $this->url = self::cleanUrl($url);
    }

    public function getSegments()
    {
        return array_filter(explode('/', $this->url));
    }

    public function __toString()
    {
        return $this->url;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public static function cleanUrl($url)
    {
        return preg_replace('#/+#', '/', $url);
    }
}
