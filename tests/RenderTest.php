<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;
use Storyblok\RichtextRender\Utils\Utils;

/**
 * @internal
 *
 * @coversNothing
 */
final class RenderTest extends TestCase
{
    public function testEscapeHml()
    {
        self::assertSame('&gt;', Utils::escapeHTMl('>'));
    }

    /**
     * @dataProvider provideRenderOpeningTagCases
     *
     * @param mixed $expected
     * @param mixed $input
     */
    public function testRenderOpeningTag($expected, $input)
    {
        $renderer = new Render();

        self::assertSame($expected, $renderer->renderOpeningTag($input));
    }

    public function provideRenderOpeningTagCases()
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
     * @dataProvider provideRenderClosingTagCases
     *
     * @param mixed $expected
     * @param mixed $input
     */
    public function testRenderClosingTag($expected, $input)
    {
        $renderer = new Render();

        self::assertSame($expected, $renderer->renderClosingTag($input));
    }

    public function provideRenderClosingTagCases()
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
