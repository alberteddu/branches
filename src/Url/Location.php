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
 * Class Location
 *
 * @package Branches\Url
 */
class Location
{
    /** @var Url */
    protected $url;

    /** @var string */
    protected $path;

    /**
     * @param Url    $url
     * @param string $path
     */
    public function __construct(Url $url, $path)
    {
        $this->url  = $url;
        $this->path = $path;
    }

    /**
     * @return Url
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }
}
