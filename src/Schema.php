<?php

namespace Storyblok\RichtextRender;

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
            'italic' => $this->get_tag('tag', 'italic'),
            'link' => $this->get_link_styled('a'),
            'styled' => $this->get_link_styled('span'),
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
            'horizontal_rule' => $this->get_tag('singleTag', 'hr'),
            'hard_break' => $this->get_tag('singleTag', 'br'),
            'image' => $this->get_image(),
            'code_block' => $this->get_code_block(),
            'heading' => $this->get_heading('tag'),
        ];
    }

    private function get_link_styled($tagName)
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

    private function get_heading($tag)
    {
        return function ($node) use ($tag) {
            return [
                $tag => "h" . $node['attrs']['level']
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

    private function get_image()
    {
        return function ($node) {
            return [
                "single_tag" => [
                    [
                        "img",
                        "attrs" => pick($node['attrs'], ['src', 'alt', 'title'])
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
                        "attrs" => $node['attrs']
                    ]
                ]
            ];
        };
    }
}
