<?php /** @noinspection HtmlUnknownAttribute */

/** @noinspection HtmlDeprecatedTag */

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;

class ResolverTest extends TestCase
{
    public function testRenderSpanWithClassAttribute()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderHrTag()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderImgTag()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderLinkTag()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderLinkTagWithCustomAttributes()
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
                                "custom" => [
                                    "rel" => "alternate"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link" target="_blank" title="Any title" rel="alternate">link text</a>';

        $this->assertEquals($resolver->render((object) $data), $expected);
    }

    public function testRenderLinkTagWithEmail()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "text" => "an email link",
                    "type" => "text",
                    "marks" => [
                        [
                            "type" => "link",
                            "attrs" => [
                                "href" => "email@client.com",
                                "target" => "_blank",
                                "linktype" => "email",
                                "title" => "Any title"
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="mailto:email@client.com" target="_blank" linktype="email" title="Any title">an email link</a>';

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderTagWithNullAttribute()
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
                                "title" => null
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link" target="_blank">link text</a>';

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderCodeTag()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderHeadingTag()
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

        $this->assertEquals($expected, $resolver->render((object)$data));

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

        $this->assertEquals($expected, $resolver->render((object)$data));
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

        $this->assertEquals($expected, $resolver->render((object)$data));
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

        $this->assertEquals($expected, $resolver->render((object)$data));
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderCustomSchema()
    {
        $custom = [
            'nodes' => [
                'paragraph' => $this->getTag("p")
            ],
            'marks' => [
                'strike' => $this->getTag("strike")
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderCustomSchemaWithoutMarks()
    {
        $custom = [
            'nodes' => [
                'paragraph' => $this->getTag("p")
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderLinkTagWithAnchor()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderLinkTagWithStory()
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
                                "uuid" => "0fe06b7d-03d8-4d66-8976-9f7febace056",
                                "target" => "_self",
                                "linktype" => "story",
                                "anchor" => "anchor-text",
                                "story" => [
                                    "_uid" => "b94a6a90-1bd4-4ee0-ac14-a09310bd6a45",
                                    "component" => "page"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<a href="/link#anchor-text" target="_self">link text</a>';

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderLinkTagWithoutAnchor()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }


    public function testRenderLinkTagWithoutAnchorButWithCssClass()
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

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testRenderParagraphWithClassAttribute()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Storyblok visual editor is ",
                            "type" => "text"
                        ],
                        [
                            "text" => "awesome!",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "styled",
                                    "attrs" => [
                                        "class" => "highlight"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<p>Storyblok visual editor is <span class="highlight">awesome!</span></p>';

        $this->assertEquals($expected, $resolver->render((object)$data));
    }


    public function testRenderParagraphWithThreeClassAttribute()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "This is a ",
                            "type" => "text"
                        ],
                        [
                            "text" => "awesome",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "styled",
                                    "attrs" => [
                                        "class" => "test"
                                    ]
                                ]
                            ]
                        ],
                        [
                            "text" => " text and this ",
                            "type" => "text"
                        ],
                        [
                            "text" => "renderer",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "styled",
                                    "attrs" => [
                                        "class" => "red"
                                    ]
                                ]
                            ]
                        ],
                        [
                            "text" => " is built with ",
                            "type" => "text"
                        ],
                        [
                            "text" => "php.",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "styled",
                                    "attrs" => [
                                        "class" => "test__red"
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<p>This is a <span class="test">awesome</span> text and this <span class="red">renderer</span> is built with <span class="test__red">php.</span></p>';

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    public function testFullText()
    {
        $resolver = new Resolver();

        $data = [
            "type" => "doc",
            "content" => [
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 1
                    ],
                    "content" => [
                        [
                            "text" => "Heading one",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sem nisi, imperdiet non ultricies at, luctus sit amet nisi.",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 2
                    ],
                    "content" => [
                        [
                            "text" => "Heading two",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Aliquam consectetur sem et convallis hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In tincidunt placerat velit vel lobortis.",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 3
                    ],
                    "content" => [
                        [
                            "text" => "Heading three",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Suspendisse ultricies urna arcu, id tincidunt nibh posuere ut. Nunc dapibus, tellus sit amet fermentum eleifend, risus augue pretium massa, a imperdiet tortor ante placerat diam.",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 4
                    ],
                    "content" => [
                        [
                            "text" => "Heading four",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Fusce non vehicula eros. Duis diam orci, efficitur porta mauris et, porttitor aliquet nisl.",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 5
                    ],
                    "content" => [
                        [
                            "text" => "Heading five",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Integer quis euismod nulla. Nam dapibus maximus nisi, in tempor ante consequat ac. Vestibulum rutrum hendrerit ex, ac dapibus dui finibus id. Praesent molestie dictum neque vel lobortis",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 6
                    ],
                    "content" => [
                        [
                            "text" => "Heading six",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Proin congue felis faucibus, volutpat lorem non, imperdiet lacus. Curabitur sed mattis tellus. Maecenas at aliquam odio",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "horizontal_rule"
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 1
                    ],
                    "content" => [
                        [
                            "text" => "More examples to another tags",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 2
                    ],
                    "content" => [
                        [
                            "text" => "Blockquote",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "blockquote",
                    "content" => [
                        [
                            "type" => "paragraph",
                            "content" => [
                                [
                                    "text" => "This is an example of blockquote",
                                    "type" => "text"
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 2
                    ],
                    "content" => [
                        [
                            "text" => "Lists",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Unordered List:",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "bullet_list",
                    "attrs" => [
                        "tight" => false
                    ],
                    "content" => [
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "Item one",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "Item two",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Bullet List:",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "bullet_list",
                    "attrs" => [
                        "tight" => false
                    ],
                    "content" => [
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "Item one",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "Item two",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Ordered List:",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "ordered_list",
                    "attrs" => [
                        "order" => 1,
                        "tight" => false
                    ],
                    "content" => [
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "Item one",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "Item two",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 2
                    ],
                    "content" => [
                        [
                            "text" => "Formats",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "Lorem ",
                            "type" => "text"
                        ],
                        [
                            "text" => "ipsum dolor",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "code"
                                ]
                            ]
                        ],
                        [
                            "text" => " sit amet, consectetur adipiscing elit. ",
                            "type" => "text"
                        ],
                        [
                            "text" => "Vestibulum",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "bold"
                                ]
                            ]
                        ],
                        [
                            "text" => " sem ",
                            "type" => "text"
                        ],
                        [
                            "text" => "nisi",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "italic"
                                ]
                            ]
                        ],
                        [
                            "text" => ", imperdiet non ultricies at, luctus sit amet nisi.",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "text" => "A link to Vue.js website",
                            "type" => "text",
                            "marks" => [
                                [
                                    "type" => "link",
                                    "attrs" => [
                                        "href" => "https://vuejs.org",
                                        "title" => null
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "paragraph",
                    "content" => [
                        [
                            "type" => "image",
                            "attrs" => [
                                "alt" => "This is the Vue.js logo",
                                "src" => "https://vuejs.org/images/logo.png",
                                "title" => null
                            ]
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 1
                    ],
                    "content" => [
                        [
                            "text" => "this is an example of fence",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "code_block",
                    "attrs" => [
                        "params" => "js"
                    ],
                    "content" => [
                        [
                            "text" => "const world = 'Hello'",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "heading",
                    "attrs" => [
                        "level" => 1
                    ],
                    "content" => [
                        [
                            "text" => "nested lists",
                            "type" => "text"
                        ]
                    ]
                ],
                [
                    "type" => "bullet_list",
                    "attrs" => [
                        "tight" => false
                    ],
                    "content" => [
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "list item",
                                            "type" => "text"
                                        ]
                                    ]
                                ],
                                [
                                    "type" => "bullet_list",
                                    "attrs" => [
                                        "tight" => false
                                    ],
                                    "content" => [
                                        [
                                            "type" => "list_item",
                                            "content" => [
                                                [
                                                    "type" => "paragraph",
                                                    "content" => [
                                                        [
                                                            "text" => "internal list item",
                                                            "type" => "text"
                                                        ]
                                                    ]
                                                ]
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ],
                        [
                            "type" => "list_item",
                            "content" => [
                                [
                                    "type" => "paragraph",
                                    "content" => [
                                        [
                                            "text" => "another list item",
                                            "type" => "text"
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];

        $expected = '<h1>Heading one</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sem nisi, imperdiet non ultricies at, luctus sit amet nisi.</p><h2>Heading two</h2><p>Aliquam consectetur sem et convallis hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In tincidunt placerat velit vel lobortis.</p><h3>Heading three</h3><p>Suspendisse ultricies urna arcu, id tincidunt nibh posuere ut. Nunc dapibus, tellus sit amet fermentum eleifend, risus augue pretium massa, a imperdiet tortor ante placerat diam.</p><h4>Heading four</h4><p>Fusce non vehicula eros. Duis diam orci, efficitur porta mauris et, porttitor aliquet nisl.</p><h5>Heading five</h5><p>Integer quis euismod nulla. Nam dapibus maximus nisi, in tempor ante consequat ac. Vestibulum rutrum hendrerit ex, ac dapibus dui finibus id. Praesent molestie dictum neque vel lobortis</p><h6>Heading six</h6><p>Proin congue felis faucibus, volutpat lorem non, imperdiet lacus. Curabitur sed mattis tellus. Maecenas at aliquam odio</p><hr /><h1>More examples to another tags</h1><h2>Blockquote</h2><blockquote><p>This is an example of blockquote</p></blockquote><h2>Lists</h2><p>Unordered List:</p><ul><li><p>Item one</p></li><li><p>Item two</p></li></ul><p>Bullet List:</p><ul><li><p>Item one</p></li><li><p>Item two</p></li></ul><p>Ordered List:</p><ol><li><p>Item one</p></li><li><p>Item two</p></li></ol><h2>Formats</h2><p>Lorem <code>ipsum dolor</code> sit amet, consectetur adipiscing elit. <b>Vestibulum</b> sem <i>nisi</i>, imperdiet non ultricies at, luctus sit amet nisi.</p><p><a href="https://vuejs.org">A link to Vue.js website</a></p><p><img alt="This is the Vue.js logo" src="https://vuejs.org/images/logo.png" /></p><h1>this is an example of fence</h1><pre><code params="js">const world = &#039;Hello&#039;</code></pre><h1>nested lists</h1><ul><li><p>list item</p><ul><li><p>internal list item</p></li></ul></li><li><p>another list item</p></li></ul>';

        $this->assertEquals($expected, $resolver->render((object)$data));
    }

    private function getTag($tag)
    {
        return static function () use ($tag) {
            return [
                "tag" => $tag
            ];
        };
    }
}
