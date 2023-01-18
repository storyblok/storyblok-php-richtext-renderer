<?php

namespace Storyblok\RichtextRender\Utils;

class Render
{
    public function escapeHTMl($html)
    {
        return htmlspecialchars($html, ENT_QUOTES);
    }

    public function renderClosingTag($tags)
    {
        if (\is_string($tags)) {
            return "</{$tags}>";
        }

        $all = [];

        foreach (array_reverse($tags) as $tag) {
            if (\is_string($tag)) {
                $all[] = "</{$tag}>";
            } else {
                $all[] = "</{$tag['tag']}>";
            }
        }

        return implode('', $all);
    }

    public function renderTag($tags, $ending)
    {
        if (\is_string($tags)) {
            return "<{$tags}{$ending}>";
        }

        $all = array_map(static function ($tag) use ($ending) {
            if (\is_string($tag)) {
                return "<{$tag}>";
            }

            $result = "<{$tag['tag']}";

            if (\array_key_exists('attrs', $tag)) {
                foreach ($tag['attrs'] as $key => $value) {
                    if (null !== $value) {
                        $result .= " {$key}=\"{$value}\"";
                    }
                }
            }

            return "{$result}{$ending}>";
        }, $tags);

        return implode('', $all);
    }

    public function renderOpeningTag($tags)
    {
        return $this->renderTag($tags, '');
    }
}
