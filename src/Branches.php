<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches;

use Branches\Extension\ExtensionInterface;
use Branches\Node\NodeInterface;
use Branches\Node\NodeNotFoundException;
use Branches\Provider\FileProvider;
use Branches\Provider\FileProviderInterface;
use Branches\Provider\PostProvider;
use Branches\Provider\PostProviderInterface;
use Branches\Resolution\FileResolution;
use Branches\Resolution\NotFoundResolution;
use Branches\Resolution\PostResolution;
use Branches\Resolution\ResolutionManager;
use Branches\Url\Url;
use Branches\Url\UrlManager;
use Branches\Url\Vote\UrlSegmentEqualityVoter;
use Exception;

/**
 * Class Branches
 *
 * @package Branches
 */
class Branches
{
    const VERSION = '0.0.1';

    /** @var string real path of the directory */
    protected $path;

    /** @var PostProviderInterface */
    protected $postProvider;

    /** @var FileProviderInterface */
    protected $fileProvider;

    /** @var ResolutionManager */
    protected $resolutionManager;

    /** @var UrlManager */
    protected $urlManager;

    /**
     * @param string $directory
     *
     * @throws Exception
     */
    public function __construct($directory)
    {
        if (!self::isDirectoryValid($directory)) {
            throw new Exception('The directory specified is not valid.');
        }

        $this->path              = realpath($directory);
        $this->postProvider      = new PostProvider($this);
        $this->fileProvider      = new FileProvider($this);
        $this->urlManager        = new UrlManager($this);
        $this->resolutionManager = new ResolutionManager($this);

        $this->urlManager->addUrlSegmentVoter(new UrlSegmentEqualityVoter());
    }

    /**
     * @param string $directory
     *
     * @return bool
     */
    public static function isDirectoryValid($directory)
    {
        return is_dir($directory) and is_readable($directory);
    }

    /**
     * Get post at $url.
     *
     * @param $url
     *
     * @return NodeInterface
     *
     * @throws NodeNotFoundException when node is not found
     */
    public function get($url)
    {
        $url      = new Url($url);
        $realPath = $this->getUrlManager()->urlMatches($url, $this->getPath());

        if ($realPath === false) {
            $resolution = new NotFoundResolution();
        } else {
            if (self::isDirectoryValid($realPath)) {
                $post       = $this->getPostProvider()->provide($url, $realPath);
                $resolution = new PostResolution($post);
            } elseif (self::isFileValid($realPath)) {
                $file       = $this->getFileProvider()->provide($url, $realPath);
                $resolution = new FileResolution($file);
            } else {
                $resolution = new NotFoundResolution();
            }
        }

        $result = $this->resolutionManager->resolve($this->resolutionManager->filterResolution($url, $resolution));

        if (is_null($result)) {
            throw new NodeNotFoundException($url, $realPath);
        }

        return $result;
    }

    /**
     * @return UrlManager
     */
    public function getUrlManager()
    {
        return $this->urlManager;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return PostProviderInterface
     */
    public function getPostProvider()
    {
        return $this->postProvider;
    }

    /**
     * @param PostProviderInterface $postProvider
     */
    public function setPostProvider(PostProviderInterface $postProvider)
    {
        $this->postProvider = $postProvider;
    }

    /**
     * @param string $file
     *
     * @return bool
     */
    public static function isFileValid($file)
    {
        return is_file($file) and is_readable($file);
    }

    /**
     * @return FileProviderInterface
     */
    public function getFileProvider()
    {
        return $this->fileProvider;
    }

    /**
     * @param FileProviderInterface $fileProvider
     */
    public function setFileProvider(FileProviderInterface $fileProvider)
    {
        $this->fileProvider = $fileProvider;
    }

    /**
     * @param string $url
     *
     * @return string
     */
    public function buildPath($url)
    {
        return \joinPaths($this->getPath(), $url);
    }

    /**
     * @return ResolutionManager
     */
    public function getResolutionManager()
    {
        return $this->resolutionManager;
    }

    /**
     * @param ExtensionInterface $extension
     */
    public function useExtension(ExtensionInterface $extension)
    {
        $extension->setBranches($this);
    }
}
