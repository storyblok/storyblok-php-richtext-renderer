<?php

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Resolver;

function getTag ($tag) {
    return function () use($tag) {
        return [
            "tag" => $tag
        ];
    };
}

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

    public function testRenderCodeTag () 
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                "type" => "code_block",
                "content" => [
                    [
                    "text" => "code",
                    "type" => "text"
                ]]
            ]]
        ];
        $expected = '<pre><code>code</code></pre>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderHeadingTag () 
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [[
                "type" => "heading",
                "attrs" => [
                    "level" => 2
                ],
                "content" => [[
                    "text" => "Lorem ipsum",
                    "type" => "text"
                ]]
            ]]
        ];
        $expected = '<h2>Lorem ipsum</h2>';

        $this->assertEquals($resolver->render((object) $data), $expected);

    }

    public function testRenderHeadingTagWhithoutLevel()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [[
                "type" => "heading",
                "content" => [[
                    "text" => "Lorem ipsum",
                    "type" => "text"
                ]]
            ]]
        ];
        $expected = '<h1>Lorem ipsum</h1>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderBulletList()
    {
        $resolver = new Resolver();
        $data = [
            'type' => 'doc',
            'content' => [[
                "type" => "bullet_list",
                "content" => [[
                    "type" => "list_item",
                    "content" => [[
                        "type" => "paragraph",
                        "content" => [[
                            "text" => "Item 1",
                            "type" => "text"
                        ]]
                    ]]
                ], [
                    "type" => "list_item",
                    "content" => [[
                        "type" => "paragraph",
                        "content" => [[
                            "text" => "Item 2",
                            "type" => "text"
                        ]]
                    ]]
                ], [
                    "type" => "list_item",
                    "content" => [[
                        "type" => "paragraph",
                        "content" => [[
                            "text" => "Item 3",
                            "type" => "text"
                        ]]
                    ]]
                ]]
            ]]
        ];

        $expected = '<ul><li><p>Item 1</p></li><li><p>Item 2</p></li><li><p>Item 3</p></li></ul>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderOrderedList()
    {
        $resolver = new Resolver();
        $data = [
            'type' => 'doc',
            'content' => [[
                "type" => "ordered_list",
                "content" => [[
                    "type" => "list_item",
                    "content" => [[
                        "type" => "paragraph",
                        "content" => [[
                            "text" => "Item 1",
                            "type" => "text"
                        ]]
                    ]]
                ], [
                    "type" => "list_item",
                    "content" => [[
                        "type" => "paragraph",
                        "content" => [[
                            "text" => "Item 2",
                            "type" => "text"
                        ]]
                    ]]
                ], [
                    "type" => "list_item",
                    "content" => [[
                        "type" => "paragraph",
                        "content" => [[
                            "text" => "Item 3",
                            "type" => "text"
                        ]]
                    ]]
                ]]
            ]]
        ];

        $expected = '<ol><li><p>Item 1</p></li><li><p>Item 2</p></li><li><p>Item 3</p></li></ol>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderComplexRender()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [[
                'type' => 'paragraph',
                'content' => [[
                    'text' => 'Lorem ',
                    'type' => 'text'
                ], [
                    'text' => 'ipsum',
                    'type' => 'text',
                    'marks' => [[
                        'type' => 'strike'
                    ]]
                ], [
                    'text' => ' dolor sit amet, ',
                    'type' => 'text'
                ], [
                    'text' => 'consectetur',
                    'type' => 'text',
                    'marks' => [[
                        'type' => 'bold'
                    ]]
                ], [
                    'text' => ' ',
                    'type' => 'text'
                ], [
                    'text' => 'adipiscing',
                    'type' => 'text',
                    'marks' => [
                        [
                            'type' => 'underline'
                        ]
                    ]
                ], [
                    'text' => ' elit. Duis in ',
                    'type' => 'text'
                ], [
                    'text' => 'sodales',
                    'type' => 'text',
                    'marks' => [[
                        'type' => 'code'
                    ]]
                ], [
                    'text' => ' metus. Sed auctor, tellus in placerat aliquet, arcu neque efficitur libero, non euismod ',
                    'type' => 'text'
                ], [
                    'text' => 'metus',
                    'type' => 'text',
                    'marks' => [[
                        'type' => 'italic'
                    ]]
                ], [
                    'text' => ' orci eu erat',
                    'type' => 'text'
                ]]
            ]]
        ];
        
        $expected = '<p>Lorem <strike>ipsum</strike> dolor sit amet, <b>consectetur</b> <u>adipiscing</u> elit. Duis in <code>sodales</code> metus. Sed auctor, tellus in placerat aliquet, arcu neque efficitur libero, non euismod <i>metus</i> orci eu erat</p>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderCustomSchema () 
    {
        $custom = [
            'nodes' => [
                'paragraph' => getTag("p")
            ],
            'marks' => [
                'strike' => getTag("strike")
            ]
        ];

        $resolver = new Resolver($custom);

        $data = [
            'type' => 'doc',
            'content' => [[
                'type' => 'paragraph',
                'content' => [[
                    'type' => 'text',
                    'text' => 'some text after ',
                ], [
                    'text' => 'strike text',
                    'type' => 'text',
                    'marks' => [[
                        'type' => 'strike'
                    ]]
                ]]
            ]]
        ];

        $expected = '<p>some text after <strike>strike text</strike></p>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderCustomSchemaWithoutMarks () 
    {
        $custom = [
            'nodes' => [
                'paragraph' => getTag("p")
            ]
        ];

        $resolver = new Resolver($custom);

        $data = [
            'type' => 'doc',
            'content' => [[
                'type' => 'paragraph',
                'content' => [[
                    'type' => 'text',
                    'text' => 'some text after ',
                ], [
                    'text' => 'strike text',
                    'type' => 'text',
                    'marks' => [[
                        'type' => 'strike'
                    ]]
                ]]
            ]]
        ];

        $expected = '<p>some text after strike text</p>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderLinkTagWithAnchor ()
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
                                "title" => "Any title",
                                "anchor" => "anchor-text"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link#anchor-text" target="_blank" title="Any title">link text</a>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderLinkTagWithoutAnchor ()
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
                                "title" => "Any title",
                                "anchor" => ""
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link" target="_blank" title="Any title">link text</a>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }



    public function testRenderLinkTagWithoutAnchorButWithCssClass ()
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
                                "title" => "Any title",
                                "anchor" => ""
                            ]
                        ],
                        [
                            "type" => "styled",
                                "attrs" => [
                                    "class" => "css__class"
                                ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link" target="_blank" title="Any title"><span class="css__class">link text</span></a>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }
}