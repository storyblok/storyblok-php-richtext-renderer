<?php

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Utils\Render;

class EscapeHtmlTest extends TestCase
{
    public function testEscapeHml()
    {
        $this->assertSame("&gt;", Render::escapeHTMl(">"));
    }
}
