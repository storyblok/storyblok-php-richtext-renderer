<?php

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Resolver;

class ResolverTest extends TestCase {
    public function testRenderSpanWithClassAttribute ()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "text" => "red text",
                    "type" => "text",
                    "marks" => [
                        [
                            "type" => "styled",
                            "attrs" => [
                                "class" => "red"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<span class="red">red text</span>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }
}