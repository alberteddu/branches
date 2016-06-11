<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Node;

use Exception;

/**
 * Class NodeNotFoundException.
 */
class NodeNotFoundException extends Exception
{
    /**
     * @var string
     */
    protected $url;

    /**
     * @param string    $url
     * @param string    $message
     * @param int       $code
     * @param Exception $previous
     */
    public function __construct($url, $message = '', $code = 0, Exception $previous = null)
    {
        if (empty($message)) {
            $message = sprintf('Node at "%s" was not found.', $url);
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * @return string
     */
    public function getUrl()
    {
        return $this->url;
    }
}
