<?php

namespace Storyblok\RichtextRender\Utils;

class Render
{
    public static function escapeHTMl($html)
    {
        return htmlspecialchars($html, ENT_QUOTES);
    }

    public static function renderClosingTag($tags)
    {
        if (gettype($tags) == "string") {
            return "</" . $tags . ">";
        }

        $all = [];

        foreach (array_reverse($tags) as $tag) {
            if (is_string($tag)) {
                array_push($all, "</" . $tag . ">");
            } else {
                array_push($all, "</" . $tag['tag'] . ">");
            }
        }

        return join("", $all);
    }

    public static function renderTag($tags, $ending)
    {
        if (is_string($tags)) {
            return "<" . $tags . $ending . ">";
        }

        $all = array_map(function ($tag) use ($ending) {
            if (is_string($tag)) {
                return "<" . $tag . ">";
            }

            $h = "<" . $tag['tag'];

            if (array_key_exists('attrs', $tag)) {
                $attrs = $tag['attrs'];

                foreach (array_keys($attrs) as $key) {
                    $h .= " " . $key . '="' . $attrs[$key] . '"';
                }
            }

            return $h . $ending . ">";
        }, $tags);

        return join("", $all);
    }

    public static function renderOpeningTag($tags)
    {
        return self::renderTag($tags, '');
    }
}
