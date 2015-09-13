<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Node;

use Branches\Branches;
use Branches\Property\PropertyHolderTrait;

/**
 * Class File
 *
 * @package Branches\Node
 */
class File extends Node implements FileInterface
{
    /**
     * @return string
     */
    public function getContent()
    {
        return file_get_contents($this->getPath());
    }

    /**
     * @return PostInterface
     */
    public function getPost()
    {
        return $this->branches->get((string) $this->getUrl()->sliceSegments(0, -1));
    }

    /**
     * @return string
     */
    public function getExtension()
    {
        return $this->getPathInfo(PATHINFO_EXTENSION);
    }

    /**
     * @return string
     */
    public function getMimeType()
    {
        return MimeType::getMimeType($this->getExtension());
    }

    /**
     * @param null $options
     *
     * @return mixed
     */
    public function getPathInfo($options = null)
    {
        return pathinfo($this->getPath(), $options);
    }
}
