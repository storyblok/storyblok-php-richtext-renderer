<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Utils;

class UtilsTest extends TestCase
{
    public function testPickToImage()
    {
        $attrs = [
            'logo' => 'logo',
            'src' => 'favicon.ico',
            'alt' => 'An favicon',
            'title' => 'An favicon'
        ];

        $allowed = ['src', 'alt', 'title'];

        $result = [
            'src' => 'favicon.ico',
            'alt' => 'An favicon',
            'title' => 'An favicon'
        ];

        $this->assertEquals(Utils::pick($attrs, $allowed), $result);
    }
}
