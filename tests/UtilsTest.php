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

        $expected = [
            'src' => 'favicon.ico',
            'alt' => 'An favicon',
            'title' => 'An favicon'
        ];

        $this->assertEquals($expected, Utils::pick($attrs, $allowed));
    }

    public function testPickEmpty()
    {
        $this->assertNull(Utils::pick([], ['src', 'alt', 'title']));
    }
}
