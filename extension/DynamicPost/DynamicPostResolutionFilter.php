<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension\DynamicPost;

use Branches\Component\BranchesAwareInterface;
use Branches\Component\BranchesAwareTrait;
use Branches\Node\File;
use Branches\Node\NodeNotFoundException;
use Branches\Node\Post;
use Branches\Node\PostInterface;
use Branches\Resolution\FileResolution;
use Branches\Resolution\Filter\ResolutionFilterInterface;
use Branches\Resolution\PostResolution;
use Branches\Resolution\ResolutionInterface;
use Branches\Resolution\ResolutionType;
use Branches\Url\Url;

/**
 * Class DynamicPostResolutionFilter
 *
 * @package Branches\Extension\DynamicPost
 */
class DynamicPostResolutionFilter implements ResolutionFilterInterface, BranchesAwareInterface
{
    use BranchesAwareTrait;

    /**
     * @param Url                 $url
     * @param ResolutionInterface $resolution
     * @param ResolutionInterface $originalResolution
     *
     * @return ResolutionInterface
     */
    public function filter(Url $url, ResolutionInterface $resolution, ResolutionInterface $originalResolution)
    {
        if ($resolution->getResolutionType() == ResolutionType::NOT_FOUND) {
            $parentUrl   = $url->sliceSegments(0, -1);

            try {
                $parent = $this->branches->get($parentUrl);

                if ($parent instanceof PostInterface) {
                    /** @var Post $child */
                    foreach ($parent->getChildren() as $child) {
                        if ($child->getUrl()->is($url)) {
                            return new PostResolution($child);
                        }
                    }

                    /** @var File $file */
                    foreach ($parent->getAttachments() as $file) {
                        if ($file->getUrl()->is($url)) {
                            return new FileResolution($file);
                        }
                    }
                }

            } catch(NodeNotFoundException $e) {
                return $originalResolution;
            }
        }

        return $originalResolution;
    }
}
