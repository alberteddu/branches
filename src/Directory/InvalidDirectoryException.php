<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Directory;

use Exception;

/**
 * Class InvalidDirectoryException.
 */
class InvalidDirectoryException extends Exception
{
    /**
     * @var string
     */
    protected $directory;

    /**
     * @param string    $directory
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($directory, $message = '', $code = 0, Exception $previous = null)
    {
        if (empty($message)) {
            $message = sprintf('Directory "%s" is not valid.', $directory);
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getDirectory()
    {
        return $this->directory;
    }
}
