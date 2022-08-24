<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

class RenderClosingTagTest extends TestCase
{
    public function testRenderClosingWithoutArgument()
    {
        $this->assertEquals('</>', Render::renderClosingTag(''));
    }

    public function testRenderClosingParagraph()
    {
        $this->assertEquals('</p>', Render::renderClosingTag('p'));
    }

    public function testRenderClosingItalic()
    {
        $this->assertEquals('</i>', Render::renderClosingTag('i'));
    }

    public function testRenderClosingPre()
    {
        $this->assertEquals('</pre>', Render::renderClosingTag('pre'));
    }

    public function testRenderClosingWithListOfObjects()
    {
        $options = [['tag' => 'p'], ['tag' => 'pre']];

        $this->assertEquals('</pre></p>', Render::renderClosingTag($options));
    }

    public function testRenderClosingWithListOfString()
    {
        $options = ['p', 'pre'];

        $this->assertEquals('</pre></p>', Render::renderClosingTag($options));
    }
}
