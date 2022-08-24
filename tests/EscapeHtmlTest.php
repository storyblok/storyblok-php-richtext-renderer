<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

class EscapeHTMLTest extends TestCase
{
    public function testEscapeHml()
    {

        $this->assertSame("&gt;", Render::escapeHTMl(">"));
    }
}
