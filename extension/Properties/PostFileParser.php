<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension\Properties;

use Mni\FrontYAML\Parser;

/**
 * Class PostFileParser
 *
 * @package Branches\Extension\Properties
 */
class PostFileParser implements NodeFileParserInterface
{
    /**
     * @param string $path
     *
     * @return array
     */
    public function parse($path)
    {
        $parser                  = new Parser();
        $document                = $parser->parse(file_get_contents($path));
        $properties              = $document->getYAML();
        $properties['__content'] = $document->getContent();

        return $properties;
    }
}
