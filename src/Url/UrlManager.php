<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */
namespace Branches\Url;

use Branches\Component\ComponentHolder;
use Branches\Extension\ExtensionInterface;
use Branches\Extension\UrlExtensionInterface;
use Branches\Manager\Manager;
use Branches\Vote\VoteResult;
use DirectoryIterator;
use FilesystemIterator;
use RecursiveDirectoryIterator;

/**
 * Class UrlManager.
 */
class UrlManager extends Manager
{
    /**
     * @param Url $url
     *
     * @return false|Location
     */
    public function urlMatches(Url $url)
    {
        $currentPath = $this->branches->getPath();
        $urlSegments = array();

        foreach ($url->getSegments() as $urlSegment) {
            $found = false;
            $realPathSegment = $urlSegment;
            $realUrlSegment = $urlSegment;

            /** @var DirectoryIterator $nodePath */
            foreach (new RecursiveDirectoryIterator($currentPath, FilesystemIterator::SKIP_DOTS) as $nodePath) {
                if ($found) {
                    break;
                }

                $pathSegment = $nodePath->getFilename();

                if (($realUrlSegment = $this->segmentMatches($urlSegment, $pathSegment))) {
                    $found = true;
                    $realPathSegment = $pathSegment;
                }
            }

            if (!$found) {
                return false;
            }

            $currentPath .= '/'.$realPathSegment;
            $urlSegments[] = $realUrlSegment;
        }

        $realUrl = new Url(implode('/', $urlSegments));

        return new Location($realUrl, $currentPath);
    }

    /**
     * @param $urlSegment
     * @param $pathSegment
     *
     * @return bool
     */
    protected function segmentMatches($urlSegment, $pathSegment)
    {
        $result = false;
        $realUrlSegment = $urlSegment;

        foreach ($this->getUrlSegmentVoters() as $urlSegmentVoter) {
            $urlSegmentVoter->setUrlSegment($urlSegmentVoter->transformSegment($urlSegment));
            $urlSegmentVoter->setPathSegment($pathSegment);

            if ($urlSegmentVoter->vote() === VoteResult::NO) {
                $result = false;
            }

            if ($urlSegmentVoter->vote() === VoteResult::YES) {
                $result = true;
                $realUrlSegment = $urlSegmentVoter->transformSegment($urlSegment);
            }
        }

        return $result ? $realUrlSegment : false;
    }

    /**
     * @return ComponentHolder
     */
    public function getUrlSegmentVoters()
    {
        return $this->branches->getExtensionManager()->collect(function (ExtensionInterface $extension, ComponentHolder $queue) {
            if ($extension instanceof UrlExtensionInterface) {
                $extension->getUrlSegmentVoters($queue);
            }
        });
    }

    /**
     * @return string
     */
    public function buildPath()
    {
        $segments = func_get_args();

        array_unshift($segments, $this->branches->getPath());

        return static::joinFromArray($segments);
    }

    /**
     * @author Riccardo Galli
     *
     * @link   http://stackoverflow.com/a/15575293/223090
     *
     * @return string
     */
    public static function join()
    {
        $paths = array();

        foreach (func_get_args() as $arg) {
            if ($arg !== '') {
                $paths[] = $arg;
            }
        }

        return preg_replace('#/+#', '/', implode('/', $paths));
    }

    /**
     * @param array $segments
     *
     * @return string
     */
    public static function joinFromArray(array $segments)
    {
        return call_user_func_array(array(__CLASS__, 'join'), $segments);
    }
}
