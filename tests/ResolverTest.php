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

    public function testRenderHrTag ()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "type" => "horizontal_rule"
                ]
            ]
        ];

        $expected = '<hr />';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderImgTag ()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "type" => "image",
                    "attrs" => [
                        "src" => "https://asset",
                        "alt" => "Any description"
                    ]
                ]
            ]
        ];

        $expected = '<img src="https://asset" alt="Any description" />';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderLinkTag ()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "text" => "link text",
                    "type" => "text",
                    "marks" => [
                        [
                            "type" => "link",
                            "attrs" => [
                                "href" => "/link",
                                "target" => "_blank",
                                "title" => "Any title"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link" target="_blank" title="Any title">link text</a>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }
}