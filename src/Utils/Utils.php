<?php

namespace Storyblok\RichtextRender\Utils;

class Utils
{
    public static function pick($attrs, $allowed)
    {
        if (empty($attrs)) {
            return null;
        }

        $result = [];

        foreach (array_keys($attrs) as $key) {
            if (\in_array($key, $allowed, true)) {
                $content = $attrs[$key];
                $result[$key] = $content;
            }
        }

        return $result;
    }

    public static function get($obj, $key, $default)
    {
        return \array_key_exists($key, $obj) ? $obj[$key] : $default;
    }

    public static function escapeHTMl($html)
    {
        return htmlspecialchars($html, ENT_QUOTES);
    }
}
