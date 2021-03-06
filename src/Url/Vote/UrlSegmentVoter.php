<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Url\Vote;

/**
 * Class UrlVoter.
 */
abstract class UrlSegmentVoter implements UrlSegmentVoterInterface
{
    /**
     * @var string
     */
    protected $urlSegment;

    /**
     * @var string
     */
    protected $pathSegment;

    /**
     * @param string $urlSegment
     */
    public function setUrlSegment($urlSegment)
    {
        $this->urlSegment = $urlSegment;
    }

    /**
     * @param string $pathSegment
     */
    public function setPathSegment($pathSegment)
    {
        $this->pathSegment = $pathSegment;
    }

    /**
     * @param string $segment
     *
     * @return string
     */
    public function transformSegment($segment)
    {
        return $segment;
    }
}
