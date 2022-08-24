<?php

namespace Storyblok\RichtextRender;

use Storyblok\RichtextRender\Utils\Render;
use Storyblok\RichtextRender\Utils\Utils;

class Resolver
{
    protected $marks;
    protected $nodes;

    public function __construct($options = [])
    {
        $_options = (array) $options;
        if (!empty($_options)) {
            $this->marks = Utils::get($_options, 'marks', []);
            $this->nodes = Utils::get($_options, 'nodes', []);
            return;
        }

        $schema = new Schema();

        $this->marks = $schema->getMarks();
        $this->nodes = $schema->getNodes();
    }

    public function render($data)
    {
        $html = '';
        $data = (array) $data;

        foreach ($data['content'] as $node) {
            $html .= $this->renderNode($node);
        }

        return $html;
    }

    protected function renderNode($item)
    {
        $html = [];

        if (array_key_exists('marks', $item)) {
            $marksArray = $item['marks'];
            foreach ($marksArray as $m) {
                $mark = $this->getMatchingMark($m);

                if ($mark) {
                    $html[] = Render::renderOpeningTag($mark['tag']);
                }
            }
        }

        $node = $this->getMatchingNode($item);

        if ($node && array_key_exists('tag', $node)) {
            $html[] = Render::renderOpeningTag($node['tag']);
        }

        if (array_key_exists('content', $item)) {
            $contentArray = $item['content'];
            foreach ($contentArray as $content) {
                $html[] = $this->renderNode($content);
            }
        } else if (array_key_exists('text', $item)) {
            $html[] = Render::escapeHTML($item['text']);
        } else if ($node && array_key_exists('single_tag', $node)) {
            $html[] = Render::renderTag($node['single_tag'], ' /');
        } else if ($node && array_key_exists('html', $node)) {
            $html[] = $node['html'];
        }

        if ($node && array_key_exists('tag', $node)) {
            $html[] = Render::renderClosingTag($node['tag']);
        }

        if (array_key_exists('marks', $item)) {
            $itemReverse = array_reverse($item['marks']);
            foreach ($itemReverse as $m) {
                $mark = $this->getMatchingMark($m);

                if ($mark) {
                    $html[] = Render::renderClosingTag($mark['tag']);
                }
            }
        }
        return implode('', $html);
    }

    protected function getMatchingNode($item)
    {
        if (array_key_exists($item['type'], $this->nodes)) {
            $fn = $this->nodes[$item['type']];

            if (is_callable($fn)) {
                return $fn($item);
            }
        }

        return null;
    }

    protected function getMatchingMark($item)
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
