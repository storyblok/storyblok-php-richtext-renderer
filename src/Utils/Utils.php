<?php
namespace Storyblok\RichtextRender\Utils;

class Utils {
    public static function pick($attrs, $allowed)
    {
        if (!$attrs || empty($attrs)) {
            return null;
        }

        $h = [];

        foreach (array_keys($attrs) as $key) {
            if (in_array($key, $allowed)) {
                $content = $attrs[$key];
                $h[$key] = $content;
            }
        }

        return $h;
    }
}