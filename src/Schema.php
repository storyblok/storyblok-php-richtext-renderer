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

    private function get_link($tagName)
    {
        return function ($node) use ($tagName) {
            if (strlen($node['attrs']['anchor']) == 0 || $node['attrs']['anchor'] == null) {
                unset($node['attrs']['anchor']);
            }

            if (array_key_exists('anchor', $node['attrs']) && $node['attrs']['anchor']) {
                $attrs = $node['attrs'];
                $attrs['href'] = $attrs['href'] . "#" . $attrs['anchor'];
                unset($attrs['anchor']);
                $node['attrs'] = $attrs;
            }

            return [
                "tag" => [
                    [
                        "tag" => $tagName,
                        "attrs" => $node['attrs']
                    ]
                ]
            ];
        };
    }

    private function get_heading($tag)
    {
        return function ($node) use ($tag) {
            return [
                $tag => "h" . $this->getLevel($node)
            ];
        };
    }

    private function get_tag($tag, $tagName)
    {
        return function () use ($tag, $tagName) {
            return [
                $tag => $tagName
            ];
        };
    }

    private function get_tag_styled($tagName)
    {
       return function ($node) use ($tagName) {
            return [
                "tag" => [
                    [
                        "tag" => $tagName,
                        "attrs" => $node['attrs']
                    ]
                ]
            ];
       };
    }

    private function get_image()
    {
        return function ($node) {
            return [
                "single_tag" => [
                    [
                        "tag" => "img",
                        "attrs" => Utils::pick($node['attrs'], ['src', 'alt', 'title'])
                    ]
                ]
            ];
        };
    }

    private function get_code_block()
    {
        return function ($node) {
            return [
                "tag" => [
                    'pre',
                    [
                        "tag" => "code",
                        "attrs" => $this->getAttrs($node)
                    ]
                ]
            ];
        };
    }

    private function getAttrs ($node) 
    {
        return Utils::get($node, 'attrs', []);
    }

    private function getLevel ($node)
    {
        if ($node) {
            if (array_key_exists("attrs", $node)) {
                $attrs = $node['attrs'];
                return Utils::get($attrs, 'level', 1);
            }
        }

        return 1;
    }
}
