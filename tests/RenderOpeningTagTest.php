<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

class RenderOpeninigTagTest extends TestCase {
    public function testRenderOpeningWithoutArgument()
    {
        $this->assertEquals(Render::renderOpeningTag(''), '<>');
    }

    public function testRenderOpeningParagraph()
    {
        $this->assertEquals(Render::renderOpeningTag('p'), '<p>');
    }

    public function testRenderOpeningWithListOfObjects()
    {
        $options = [[ 'tag' => 'p' ], [ 'tag' => 'pre' ]];

        $this->assertEquals(Render::renderOpeningTag($options), '<p><pre>');
    }

    public function testRenderOpeningWithListOfStrings()
    {
        $options = ['p', 'pre'];

        $this->assertEquals(Render::renderOpeningTag($options), '<p><pre>');
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
            [ 'tag' => 'pre' ]
        ];

        $this->assertEquals(Render::renderOpeningTag($options), '<p class="is-active"><pre>');
    }
}
