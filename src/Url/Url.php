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

    /**
     * @param $url
     */
    public function __construct($url)
    {
        $this->setUrl($url);
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

    /**
     * @param int      $offset
     * @param int|null $length
     *
     * @return Url
     */
    public function sliceSegments($offset, $length = null)
    {
        return new self(implode('/', array_slice($this->getSegments(), $offset, $length)));
    }

    /**
     * @return array
     */
    public function getSegments()
    {
        return array_filter(explode('/', $this->url));
    }

    /**
     * @return bool
     */
    public function isRoot()
    {
        return count($this->getSegments()) == 0;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->url;
    }

    /**
     * @param string $url
     */
    public function setUrl($url)
    {
        $this->url = self::cleanUrl($url);
    }
}
