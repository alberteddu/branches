<?php

/**
 * This file is part of the Branches package.
 * For the full license information, see the file LICENSE.
 *
 * @author   Alberto Piu <alberteddu@gmail.com>
 * @license  MIT
 */

namespace Branches\Extension\Properties;

use Branches\Component\BranchesAwareInterface;
use Branches\Component\BranchesAwareTrait;
use Branches\Node\AbstractPost;
use Branches\Node\File;
use Branches\Node\Post;
use Branches\Resolution\Filter\ResolutionFilterInterface;
use Branches\Resolution\ResolutionInterface;
use Branches\Resolution\ResolutionType;
use Branches\Url\Url;

/**
 * Class PropertiesResolutionFilter
 *
 * @package Branches\Extension\DynamicPost
 */
class PropertiesResolutionFilter implements ResolutionFilterInterface, BranchesAwareInterface
{
    use BranchesAwareTrait;

    /** @var array */
    protected static $defaultExtensions = array('md', 'markdown', 'txt');

    /** @var array */
    protected $extensions;

    /** @var NodeFileParserInterface */
    protected $postFileParser;

    /**
     * @param array                   $extensions
     * @param NodeFileParserInterface $postFileParser
     */
    public function __construct(array $extensions = null, NodeFileParserInterface $postFileParser = null)
    {
        if (is_null($extensions)) {
            $extensions = static::$defaultExtensions;
        }

        if (is_null($postFileParser)) {
            $postFileParser = new PostFileParser();
        }

        $this->extensions     = $extensions;
        $this->postFileParser = $postFileParser;
    }

    /**
     * @param Url                 $url
     * @param ResolutionInterface $resolution
     * @param ResolutionInterface $originalResolution
     *
     * @return ResolutionInterface
     */
    public function filter(Url $url, ResolutionInterface $resolution, ResolutionInterface $originalResolution)
    {
        if ($resolution->getResolutionType() === ResolutionType::POST) {
            $post = $resolution->getNode();

            if ($post instanceof Post and !$post instanceof AbstractPost) {
                /** @var File $attachment */
                foreach ($post->getAttachments(true) as $attachment) {
                    if (in_array($attachment->getExtension(), $this->extensions)) {
                        $post->mergeProperties($this->postFileParser->parse($attachment->getPath()));

                        break;
                    }
                }
            }
        }

        return $resolution;
    }

    /**
     * @return array
     */
    public static function getDefaultExtensions()
    {
        return self::$defaultExtensions;
    }
}
