<?php

namespace Storyblok\RichtextRender;

use Storyblok\RichtextRender\Schema;
use Storyblok\RichtextRender\Utils\Render;

class Resolver
{
    private $marks = [];
    private $nodes = [];

    function __construct($options = [])
    {
        if (!empty($options)) {
            $this->marks = $options['marks'];
            $this->nodes = $options['nodes'];
            return null;
        }

        $schema = new Schema();

        $this->marks = $schema->getMarks();
        $this->nodes = $schema->getNodes();
    }

    function render($data)
    {
        $html = '';
        $data = (array) $data;

        foreach ($data['content'] as $node) {
            $html .= $this->renderNode($node);
        }

        return $html;
    }

    function renderNode($item)
    {
        $html = [];

        if (array_key_exists('marks', $item)) {
            $marksArray = $item['marks'];
            foreach ($marksArray as $key => $m) {
                $mark = $this->getMatchingMark($m);

                if ($mark) {
                    array_push($html, Render::renderOpeningTag($mark['tag']));
                }
            }
        }

        $node = $this->getMatchingNode($item);

        var_dump($this->nodes);

        if ($node && $node['tag']) {
            array_push($html, Render::renderOpeningTag($node['tag']));
        }

        if (array_key_exists('content', $item)) {
            $contentArray = $item['content'];
            foreach ($contentArray as $key => $content) {
                array_push($html, Render::renderNode($content));
            }
        } else if (array_key_exists('text', $item)) {
            array_push($html, Render::escapeHTML($item['text']));
        } else if ($node && array_key_exists('singleTag', $node)) {
            array_push($html, Render::renderTag($node['singleTag'], ' /'));
        } else if ($node && array_key_exists('html', $node)) {
            array_push($html, $node['html']);
        }

        if ($node && array_key_exists('tag', $node)) {
            array_push($html, Render::renderClosingTag($node['tag']));
        }

        if (array_key_exists('marks', $item)) {
            $itemReverse = array_reverse($item['marks']);
            foreach ($itemReverse as $key => $m) {
                $mark = $this->getMatchingMark($m);

                if ($mark) {
                    array_push($html, Render::renderClosingTag($mark['tag']));
                }
            }
        }
        return join(" ", $html);
    }

    function getMatchingNode($item)
    {
        if (array_key_exists($item['type'], $this->nodes)) {
            $fn = $this->nodes[$item['type']];

            if (is_callable($fn)) {
                return $fn($item);
            }
        }

        return null;
    }

    function getMatchingMark($item)
    {
        if (array_key_exists($item['type'], $this->marks)) {
            $fn = $this->marks[$item['type']];

            if (is_callable($fn)) {
                return $fn($item);
            }
        }

        return null;
    }
}
