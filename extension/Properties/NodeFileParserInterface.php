<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension\Properties;

/**
 * Interface NodeFileParserInterface
 *
 * @package Branches\Extension\Properties
 */
interface NodeFileParserInterface
{
    /**
     * @param string $path
     *
     * @return array
     */
    public function parse($path);
}
