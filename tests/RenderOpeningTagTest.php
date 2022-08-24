<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

class RenderOpeningTagTest extends TestCase
{
    public function testRenderOpeningWithoutArgument()
    {
        $this->assertEquals('<>', Render::renderOpeningTag(''));
    }

    public function testRenderOpeningParagraph()
    {
        $this->assertEquals('<p>', Render::renderOpeningTag('p'));
    }

    public function testRenderOpeningWithListOfObjects()
    {
        $options = [['tag' => 'p'], ['tag' => 'pre']];

        $this->assertEquals('<p><pre>', Render::renderOpeningTag($options));
    }

    public function testRenderOpeningWithListOfStrings()
    {
        $options = ['p', 'pre'];

        $this->assertEquals('<p><pre>', Render::renderOpeningTag($options));
    }

    public function testRenderOpeningWithListOfObjectsWithAttrs()
    {
        $options = [
            [
                'tag' => 'p',
                'attrs' => [
                    'class' => 'is-active'
                ]
            ],
            ['tag' => 'pre']
        ];

        $this->assertEquals('<p class="is-active"><pre>', Render::renderOpeningTag($options));
    }
}
