<?php

namespace Storyblok\RichtextRender;

use Storyblok\RichtextRender\Utils\Utils;

class Schema
{
    public function getMarks()
    {
        return [
            'bold' => $this->get_tag('tag', 'b'),
            'strike' => $this->get_tag('tag', 'strike'),
            'underline' => $this->get_tag('tag', 'u'),
            'strong' => $this->get_tag('tag', 'strong'),
            'code' => $this->get_tag('tag', 'code'),
            'italic' => $this->get_tag('tag', 'i'),
            'link' => $this->get_link('a'),
            'styled' => $this->get_tag_styled('span'),
        ];
    }

    public function getNodes()
    {
        return [
            'blockquote' => $this->get_tag('tag', 'blockquote'),
            'bullet_list' => $this->get_tag('tag', 'ul'),
            'list_item' => $this->get_tag('tag', 'li'),
            'ordered_list' => $this->get_tag('tag', 'ol'),
            'paragraph' => $this->get_tag('tag', 'p'),
            'horizontal_rule' => $this->get_tag('single_tag', 'hr'),
            'hard_break' => $this->get_tag('single_tag', 'br'),
            'image' => $this->get_image(),
            'code_block' => $this->get_code_block(),
            'heading' => $this->get_heading('tag'),
        ];
    }

    protected function get_link($tagName)
    {
        return static function ($node) use ($tagName) {
            $attrs = $node['attrs'];
            $linkType = Utils::get($attrs, 'linktype', 'url');
            unset($attrs['linktype']);

            if (\array_key_exists('anchor', $attrs)) {
                $anchor = $attrs['anchor'];

                if ('' !== $anchor && null !== $anchor) {
                    $attrs['href'] .= '#' . $anchor;
                }

                unset($attrs['anchor']);
            }

            if ('email' === $linkType) {
                $attrs['href'] = 'mailto:' . $attrs['href'];
            }

            if ('story' === $linkType) {
                unset($attrs['story'], $attrs['uuid']);
            }

            if (isset($attrs['custom']) && is_array($attrs['custom'])) {
                $attrs = array_merge($attrs, $attrs['custom']);
            }
            unset($attrs['custom']);

            return [
                'tag' => [
                    [
                        'tag' => $tagName,
                        'attrs' => $attrs,
                    ],
                ],
            ];
        };
    }

    protected function get_heading($tag)
    {
        return function ($node) use ($tag) {
            return [
                $tag => 'h' . $this->getLevel($node),
            ];
        };
    }

    protected function get_tag($tag, $tagName)
    {
        return static function () use ($tag, $tagName) {
            return [
                $tag => $tagName,
            ];
        };
    }

    protected function get_tag_styled($tagName)
    {
        return static function ($node) use ($tagName) {
            return [
                'tag' => [
                    [
                        'tag' => $tagName,
                        'attrs' => $node['attrs'],
                    ],
                ],
            ];
        };
    }

    protected function get_image()
    {
        return static function ($node) {
            return [
                'single_tag' => [
                    [
                        'tag' => 'img',
                        'attrs' => Utils::pick($node['attrs'], ['src', 'alt', 'title']),
                    ],
                ],
            ];
        };
    }

    protected function get_code_block()
    {
        return function ($node) {
            return [
                'tag' => [
                    'pre',
                    [
                        'tag' => 'code',
                        'attrs' => $this->getAttrs($node),
                    ],
                ],
            ];
        };
    }

    protected function getAttrs($node)
    {
        return Utils::get($node, 'attrs', []);
    }

    protected function getLevel($node)
    {
        if ($node && \array_key_exists('attrs', $node)) {
            $attrs = $node['attrs'];

            return Utils::get($attrs, 'level', 1);
        }

        return 1;
    }
}
