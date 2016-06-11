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
 * Class Url.
 */
class Url
{
    /**
     * @var string
     */
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
     */
    public function setUrl($url)
    {
        $this->url = self::cleanUrl($url);
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public static function cleanUrl($url)
    {
        return preg_replace('#/+#', '/', '/'.$url);
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
        return array_values(array_filter(explode('/', $this->url)));
    }

    /**
     * @return string
     */
    public function getLastSegment()
    {
        $segments = $this->getSegments();

        if (count($segments) == 0) {
            return null;
        }

        return $segments[count($segments) - 1];
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
     *
     * @return Url
     */
    public function append($url)
    {
        return new self(UrlManager::join($this->url, $url));
    }

    /**
     * @param Url $url
     *
     * @return bool
     */
    public function is(Url $url)
    {
        return $this == $url;
    }

    /**
     * @param string $pattern
     * @param array  $matches
     *
     * @return int
     */
    public function match($pattern, array &$matches = null)
    {
        return preg_match($pattern, $this->url, $matches);
    }
}
