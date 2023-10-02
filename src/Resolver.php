<?php

namespace Storyblok\RichtextRender;

use Storyblok\RichtextRender\Utils\Render;
use Storyblok\RichtextRender\Utils\Utils;

class Resolver
{
    protected $renderer;
    protected $marks;
    protected $nodes;

    public function __construct($options = [], Render $renderer = null)
    {
        $this->renderer = $renderer ?: new Render();

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

    public function render($data, $options = [])
    {
        $html = '';
        $data = (array) $data;

        foreach ($data['content'] as $node) {
            $html .= $this->renderNode($node);
        }

        if ($options['optimizeImages'] ?? false) {
            $html = $this->optimizeImages($html, $options['optimizeImages']);
        }

        return $html;
    }

    protected function renderNode($item)
    {
        $html = [];

        if (\array_key_exists('marks', $item)) {
            $marksArray = $item['marks'];
            foreach ($marksArray as $m) {
                $mark = $this->getMatchingMark($m);

                if ($mark && isset($mark['tag'])) {
                    $html[] = $this->renderer->renderOpeningTag($mark['tag']);
                }
            }
        }

        $node = $this->getMatchingNode($item);

        if ($node && \array_key_exists('tag', $node)) {
            $html[] = $this->renderer->renderOpeningTag($node['tag']);
        }

        if (\array_key_exists('content', $item)) {
            $contentArray = $item['content'];
            foreach ($contentArray as $content) {
                $html[] = $this->renderNode($content);
            }
        } elseif (\array_key_exists('text', $item)) {
            $html[] = Utils::escapeHTML($item['text']);
        } elseif ($node && \array_key_exists('single_tag', $node)) {
            $html[] = $this->renderer->renderTag($node['single_tag'], ' /');
        } elseif ($node && \array_key_exists('html', $node)) {
            $html[] = $node['html'];
        } elseif (\array_key_exists('type', $item) && 'emoji' === $item['type']) {
            $html[] = $this->renderer->renderEmoji($item);
        }

        if ($node && \array_key_exists('tag', $node)) {
            $html[] = $this->renderer->renderClosingTag($node['tag']);
        }

        if (\array_key_exists('marks', $item)) {
            $itemReverse = array_reverse($item['marks']);
            foreach ($itemReverse as $m) {
                $mark = $this->getMatchingMark($m);

                if ($mark && isset($mark['tag'])) {
                    $html[] = $this->renderer->renderClosingTag($mark['tag']);
                }
            }
        }

        return implode('', $html);
    }

    protected function getMatchingNode($item)
    {
        if (\array_key_exists($item['type'], $this->nodes)) {
            $fn = $this->nodes[$item['type']];

            if (\is_callable($fn)) {
                return $fn($item);
            }
        }

        return null;
    }

    protected function getMatchingMark($item)
    {
        if (\array_key_exists($item['type'], $this->marks)) {
            $fn = $this->marks[$item['type']];

            if (\is_callable($fn)) {
                return $fn($item);
            }
        }

        return null;
    }

    protected function optimizeImages($html, $options)
    {
        $w = 0;
        $h = 0;
        $imageAttributes = '';
        $filters = '';

        if (!\is_bool($options)) {
            if (isset($options['width']) && is_numeric($options['width']) && $options['width'] > 0) {
                $imageAttributes .= " width=\"{$options['width']}\"";
                $w = $options['width'];
            }

            if (isset($options['height']) && is_numeric($options['height']) && $options['height'] > 0) {
                $imageAttributes .= " height=\"{$options['height']}\"";
                $h = $options['height'];
            }

            if (isset($options['loading']) && ('lazy' === $options['loading'] || 'eager' === $options['loading'])) {
                $imageAttributes .= " loading=\"{$options['loading']}\"";
            }

            if (isset($options['class']) && \is_string($options['class']) && '' !== $options['class']) {
                $imageAttributes .= " class=\"{$options['class']}\"";
            }

            if (isset($options['filters']) && \is_array($options['filters'])) {
                if (
                    isset($options['filters']['blur'])
                    && $options['filters']['blur'] >= -100
                    && $options['filters']['blur'] <= 100
                ) {
                    $filters .= ":blur({$options['filters']['blur']})";
                }

                if (
                    isset($options['filters']['brightness'])
                    && $options['filters']['brightness'] >= -100
                    && $options['filters']['brightness'] <= 100
                ) {
                    $filters .= ":brightness({$options['filters']['brightness']})";
                }

                if (
                    isset($options['filters']['fill'])
                    && (preg_match('/^[0-9A-Fa-f]{6}$/i', $options['filters']['fill']) || 'transparent' === $options['filters']['fill'])
                ) {
                    $filters .= ":fill({$options['filters']['fill']})";
                }

                if (
                    isset($options['filters']['format'])
                    && \in_array($options['filters']['format'], ['webp', 'jpeg', 'png'], true)
                ) {
                    $filters .= ':format(' . strtolower($options['filters']['format']) . ')';
                }

                if (
                    isset($options['filters']['grayscale'])
                    && \is_bool($options['filters']['grayscale'])
                ) {
                    $filters .= ':grayscale()';
                }

                if (
                    isset($options['filters']['quality'])
                    && $options['filters']['quality'] >= 0
                    && $options['filters']['quality'] <= 100
                ) {
                    $filters .= ":quality({$options['filters']['quality']})";
                }

                if (
                    isset($options['filters']['rotate'])
                    && \in_array($options['filters']['rotate'], [90, 180, 270], true)
                ) {
                    $filters .= ":rotate({$options['filters']['rotate']})";
                }

                if ('' !== $filters) {
                    $filters = '/filters' . $filters;
                }
            }
        }

        if ('' !== $imageAttributes) {
            $html = str_replace('<img', '<img ' . trim($imageAttributes), $html);
        }

        $parameters = $w > 0 || $h > 0 || '' !== $filters ? $w . 'x' . $h . $filters : '';

        $html = preg_replace(
            '/a.storyblok.com\/f\/(\d+)\/([^.]+)\.(gif|jpg|jpeg|png|tif|tiff|bmp)/',
            'a.storyblok.com/f/$1/$2.$3/m/' . $parameters,
            $html
        );

        if (isset($options['srcset']) || isset($options['sizes'])) {
            $html = preg_replace_callback(
                '/<img.*?src=["|\'](.*?)["|\']/',
                static function ($matches) use ($filters, $options) {
                    $url = $matches[1];
                    $srcsetList = [];
                    $sizesList = [];

                    if (preg_match('/a.storyblok.com\/f\/(\d+)\/([^.]+)\.(gif|jpg|jpeg|png|tif|tiff|bmp)/', $url, $urlMatches)) {

                        if (isset($options['srcset']) && \is_array($options['srcset'])) {
                            foreach ($options['srcset'] as $value) {
                                if (is_numeric($value)) {
                                    $srcsetList[] = '//' . $urlMatches[0] . '/m/' . $value . 'x0' . $filters . ' ' . $value . 'w';
                                }
                                if (\is_array($value) && 2 === \count($value)) {
                                    is_numeric($value[0]) ? $w = $value[0] : $w = 0;
                                    is_numeric($value[0]) ? $h = $value[1] : $h = 0;

                                    $srcsetList[] = '//' . $urlMatches[0] . '/m/' . $w . 'x' . $h . $filters . ' ' . $w . 'w';
                                }
                            }
                        }

                        if (isset($options['sizes']) && \is_array($options['sizes'])) {
                            foreach ($options['sizes'] as $size) {
                                $sizesList[] = $size;
                            }
                        }

                        $attributesToRender = '';

                        if (\count($srcsetList) > 0) {
                            $attributesToRender .= 'srcset="' . implode(', ', $srcsetList) . '" ';
                        }
                        if (\count($sizesList) > 0) {
                            $attributesToRender .= 'sizes="' . implode(', ', $sizesList) . '" ';
                        }

                        return preg_replace('/<img/', '<img ' . trim($attributesToRender), $matches[0]);
                    }

                    return $matches[0];
                },
                $html
            );
        }

        return $html;
    }
}
