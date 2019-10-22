<?php

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

class RenderClosingTagTest extends TestCase {
    public function testRenderClosingWithoutArgument()
    {
        $this->assertEquals(Render::renderClosingTag(''), '</>');
    }

    public function testRenderClosingParagraph()
    {
        $this->assertEquals(Render::renderClosingTag('p'), '</p>');
    }

    public function testRenderClosingItalic()
    {
        $this->assertEquals(Render::renderClosingTag('i'), '</i>');
    }

    public function testRenderClosingPre()
    {
        $this->assertEquals(Render::renderClosingTag('pre'), '</pre>');
    }

    public function testRenderClosingWithListOfObjects()
    {
        $options = [[ 'tag' => 'p' ], [ 'tag' => 'pre' ]];

        $this->assertEquals(Render::renderClosingTag($options), '</pre></p>');
    }

    public function testRenderClosingWithListOfString()
    {
        $options = ['p', 'pre'];

        $this->assertEquals(Render::renderClosingTag($options), '</pre></p>');
    }
}