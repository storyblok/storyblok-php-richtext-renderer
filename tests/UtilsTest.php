<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Utils;

/**
 * @internal
 *
 * @coversNothing
 */
final class UtilsTest extends TestCase
{
    public function testPickToImage()
    {
        $attrs = [
            'logo' => 'logo',
            'src' => 'favicon.ico',
            'alt' => 'An favicon',
            'title' => 'An favicon',
        ];

        $allowed = ['src', 'alt', 'title'];

        $expected = [
            'src' => 'favicon.ico',
            'alt' => 'An favicon',
            'title' => 'An favicon',
        ];

        static::assertSame($expected, Utils::pick($attrs, $allowed));
    }

    public function testPickEmpty()
    {
        static::assertNull(Utils::pick([], ['src', 'alt', 'title']));
    }
}
