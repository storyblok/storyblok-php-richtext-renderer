<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

/**
 * @internal
 *
 * @coversNothing
 */
final class RenderTest extends TestCase
{
    public function testEscapeHml()
    {
        $renderer = new Render();

        static::assertSame('&gt;', $renderer->escapeHTMl('>'));
    }

    /**
     * @dataProvider renderOpeningTagDataProvider
     *
     * @param mixed $expected
     * @param mixed $input
     */
    public function testRenderOpeningTag($expected, $input)
    {
        $renderer = new Render();

        static::assertSame($expected, $renderer->renderOpeningTag($input));
    }

    public function renderOpeningTagDataProvider()
    {
        return [
            'without argument' => [
                '$expected' => '<>',
                '$input' => '',
            ],
            'paragraph' => [
                '$expected' => '<p>',
                '$input' => 'p',
            ],
            'list of objects' => [
                '$expected' => '<p><pre>',
                '$input' => [['tag' => 'p'], ['tag' => 'pre']],
            ],
            'list of strings' => [
                '$expected' => '<p><pre>',
                '$input' => ['p', 'pre'],
            ],
            'list of objects with attrs' => [
                '$expected' => '<p class="is-active"><pre>',
                '$input' => [
                    [
                        'tag' => 'p',
                        'attrs' => [
                            'class' => 'is-active',
                        ],
                    ],
                    ['tag' => 'pre'],
                ],
            ],
        ];
    }

    /**
     * @dataProvider renderClosingTagDataProvider
     *
     * @param mixed $expected
     * @param mixed $input
     */
    public function testRenderClosingTag($expected, $input)
    {
        $renderer = new Render();

        static::assertSame($expected, $renderer->renderClosingTag($input));
    }

    public function renderClosingTagDataProvider()
    {
        return [
            'without argument' => [
                '$expected' => '</>',
                '$input' => '',
            ],
            'paragraph' => [
                '$expected' => '</p>',
                '$input' => 'p',
            ],
            'italic' => [
                '$expected' => '</i>',
                '$input' => 'i',
            ],
            'pre' => [
                '$expected' => '</pre>',
                '$input' => 'pre',
            ],
            'list of objects' => [
                '$expected' => '</pre></p>',
                '$input' => [['tag' => 'p'], ['tag' => 'pre']],
            ],
            'list of strings' => [
                '$expected' => '</pre></p>',
                '$input' => ['p', 'pre'],
            ],
        ];
    }
}
