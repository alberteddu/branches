<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches;

use Branches\Component\BranchesAwareInterface;
use Branches\Extension\ExtensionInterface;
use Branches\Extension\ExtensionManager;
use Branches\Node\NodeInterface;
use Branches\Node\NodeNotFoundException;
use Branches\Node\NodeManager;
use Branches\Provider\FileListProvider;
use Branches\Provider\FileListProviderInterface;
use Branches\Provider\FileProvider;
use Branches\Provider\FileProviderInterface;
use Branches\Provider\PostListProvider;
use Branches\Provider\PostListProviderInterface;
use Branches\Provider\PostProvider;
use Branches\Provider\PostProviderInterface;
use Branches\Resolution\ResolutionManager;
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

    /** @var PostListProviderInterface */
    protected $postListProvider;

    /** @var FileListProviderInterface */
    protected $fileListProvider;

    /** @var ResolutionManager */
    protected $resolutionManager;

    /** @var UrlManager */
    protected $urlManager;

    /** @var NodeManager */
    protected $nodeManager;

    /** @var ExtensionManager */
    protected $extensionManager;

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
        $this->postListProvider  = new PostListProvider($this);
        $this->fileListProvider  = new FileListProvider($this);
        $this->resolutionManager = new ResolutionManager($this);
        $this->urlManager        = new UrlManager($this);
        $this->nodeManager       = new NodeManager($this);
        $this->extensionManager  = new ExtensionManager($this);

        $this->useExtension(new UrlSegmentEqualityVoter());
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
     * @param $url
     *
     * @return NodeInterface
     *
     * @throws NodeNotFoundException
     */
    public function get($url = '/')
    {
        return $this->nodeManager->get($url);
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
     * @return NodeManager
     */
    public function getNodeManager()
    {
        return $this->nodeManager;
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
     * @return PostListProviderInterface
     */
    public function getPostListProvider()
    {
        return $this->postListProvider;
    }

    /**
     * @param PostListProviderInterface $postListProvider
     */
    public function setPostListProvider($postListProvider)
    {
        $this->postListProvider = $postListProvider;
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
        if($extension instanceof BranchesAwareInterface) {
            $extension->setBranches($this);
        }

        $this->extensionManager->register($extension->getName(), $extension);
    }

    /**
     * @return FileListProviderInterface
     */
    public function getFileListProvider()
    {
        return $this->fileListProvider;
    }

    /**
     * @param FileListProviderInterface $fileListProvider
     */
    public function setFileListProvider($fileListProvider)
    {
        $this->fileListProvider = $fileListProvider;
    }

    /**
     * @return ExtensionManager
     */
    public function getExtensionManager()
    {
        return $this->extensionManager;
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
}
