<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Dynamic;

use Branches\Branches;
use Branches\Property\PropertyHolderTrait;
use Branches\Url\Url;

/**
 * Class DynamicPost
 *
 * @package Branches\Dynamic
 */
class DynamicPost
{
    use PropertyHolderTrait;

    /** @var string */
    protected $segment;

    /**
     * @param string $segment
     * @param array  $properties
     */
    public function __construct($segment, $properties = array())
    {
        $this->segment = $segment;
        $this->setProperties($properties);
    }

    /**
     * @return string
     */
    public function getSegment()
    {
        return $this->segment;
    }
}
