<?php

namespace Storyblok\RichtextRender\Fixtures;

class ResolverTestData
{
  public static function spanWithClassAttribute()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'text' => 'red text',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'styled',
                        'attrs' => [
                            'class' => 'red',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function linkTag()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'text' => 'link text',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => '/link',
                            'target' => '_blank',
                            'linktype' => 'link',
                            'title' => 'Any title',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function linkTagWithEmptyCustomAttributes()
  {
    return [
		'type' => 'doc',
		'content' => [
			[
				'text' => 'link text',
				'type' => 'text',
				'marks' => [
					[
						'type' => 'link',
						'attrs' => [
							'href' => '/link',
							'target' => '_blank',
							'title' => 'Any title',
							'custom' => [],
						],
					],
				],
			],
		],
	];
  }

  public static function linkTagWithEmail()
  {
    return [
		'type' => 'doc',
		'content' => [
			[
				'text' => 'an email link',
				'type' => 'text',
				'marks' => [
					[
						'type' => 'link',
						'attrs' => [
							'href' => 'email@client.com',
							'target' => '_blank',
							'linktype' => 'email',
							'title' => 'Any title',
						],
					],
				],
			],
		],
	];
  }

  public static function tagWithNullAttribute()
  {
    return [
		'type' => 'doc',
		'content' => [
			[
				'text' => 'link text',
				'type' => 'text',
				'marks' => [
					[
						'type' => 'link',
						'attrs' => [
							'href' => '/link',
							'target' => '_blank',
							'title' => null,
						],
					],
				],
			],
		],
	];
  }

  public static function bulletList()
  {
    return [
        'type' => 'doc',
        'content' => [[
            'type' => 'bullet_list',
            'content' => [[
                'type' => 'list_item',
                'content' => [[
                    'type' => 'paragraph',
                    'content' => [[
                        'text' => 'Item 1',
                        'type' => 'text',
                    ]],
                ]],
            ], [
                'type' => 'list_item',
                'content' => [[
                    'type' => 'paragraph',
                    'content' => [[
                        'text' => 'Item 2',
                        'type' => 'text',
                    ]],
                ]],
            ], [
                'type' => 'list_item',
                'content' => [[
                    'type' => 'paragraph',
                    'content' => [[
                        'text' => 'Item 3',
                        'type' => 'text',
                    ]],
                ]],
            ]],
        ]],
    ];
  }

  public static function orderedList()
  {
    return  [
            'type' => 'doc',
            'content' => [[
                'type' => 'ordered_list',
                'content' => [[
                    'type' => 'list_item',
                    'content' => [[
                        'type' => 'paragraph',
                        'content' => [[
                            'text' => 'Item 1',
                            'type' => 'text',
                        ]],
                    ]],
                ], [
                    'type' => 'list_item',
                    'content' => [[
                        'type' => 'paragraph',
                        'content' => [[
                            'text' => 'Item 2',
                            'type' => 'text',
                        ]],
                    ]],
                ], [
                    'type' => 'list_item',
                    'content' => [[
                        'type' => 'paragraph',
                        'content' => [[
                            'text' => 'Item 3',
                            'type' => 'text',
                        ]],
                    ]],
                ]],
            ]],
        ];
  }

  public static function complexData()
  {
    return [
        'type' => 'doc',
        'content' => [[
            'type' => 'paragraph',
            'content' => [[
                'text' => 'Lorem ',
                'type' => 'text',
            ], [
                'text' => 'ipsum',
                'type' => 'text',
                'marks' => [[
                    'type' => 'strike',
                ]],
            ], [
                'text' => ' dolor sit amet, ',
                'type' => 'text',
            ], [
                'text' => 'consectetur',
                'type' => 'text',
                'marks' => [[
                    'type' => 'bold',
                ]],
            ], [
                'text' => ' ',
                'type' => 'text',
            ], [
                'text' => 'adipiscing',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'underline',
                    ],
                ],
            ], [
                'text' => ' elit. Duis in ',
                'type' => 'text',
            ], [
                'text' => 'sodales',
                'type' => 'text',
                'marks' => [[
                    'type' => 'code',
                ]],
            ], [
                'text' => ' metus. Sed auctor, tellus in placerat aliquet, arcu neque efficitur libero, non euismod ',
                'type' => 'text',
            ], [
                'text' => 'metus',
                'type' => 'text',
                'marks' => [[
                    'type' => 'italic',
                ]],
            ], [
                'text' => ' orci eu erat',
                'type' => 'text',
            ]],
        ]],
    ];
  }

  public static function paragraphWithThreeClassAttribute()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'This is a ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'awesome',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'styled',
                                'attrs' => [
                                    'class' => 'test',
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => ' text and this ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'renderer',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'styled',
                                'attrs' => [
                                    'class' => 'red',
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => ' is built with ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'php.',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'styled',
                                'attrs' => [
                                    'class' => 'test__red',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function fullText()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                ],
                'content' => [
                    [
                        'text' => 'Heading one',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sem nisi, imperdiet non ultricies at, luctus sit amet nisi.',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 2,
                ],
                'content' => [
                    [
                        'text' => 'Heading two',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Aliquam consectetur sem et convallis hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In tincidunt placerat velit vel lobortis.',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 3,
                ],
                'content' => [
                    [
                        'text' => 'Heading three',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Suspendisse ultricies urna arcu, id tincidunt nibh posuere ut. Nunc dapibus, tellus sit amet fermentum eleifend, risus augue pretium massa, a imperdiet tortor ante placerat diam.',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 4,
                ],
                'content' => [
                    [
                        'text' => 'Heading four',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Fusce non vehicula eros. Duis diam orci, efficitur porta mauris et, porttitor aliquet nisl.',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 5,
                ],
                'content' => [
                    [
                        'text' => 'Heading five',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Integer quis euismod nulla. Nam dapibus maximus nisi, in tempor ante consequat ac. Vestibulum rutrum hendrerit ex, ac dapibus dui finibus id. Praesent molestie dictum neque vel lobortis',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 6,
                ],
                'content' => [
                    [
                        'text' => 'Heading six',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Proin congue felis faucibus, volutpat lorem non, imperdiet lacus. Curabitur sed mattis tellus. Maecenas at aliquam odio',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'horizontal_rule',
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                ],
                'content' => [
                    [
                        'text' => 'More examples to another tags',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 2,
                ],
                'content' => [
                    [
                        'text' => 'Blockquote',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'blockquote',
                'content' => [
                    [
                        'type' => 'paragraph',
                        'content' => [
                            [
                                'text' => 'This is an example of blockquote',
                                'type' => 'text',
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 2,
                ],
                'content' => [
                    [
                        'text' => 'Lists',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Unordered List:',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'bullet_list',
                'attrs' => [
                    'tight' => false,
                ],
                'content' => [
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'Item one',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'Item two',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Bullet List:',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'bullet_list',
                'attrs' => [
                    'tight' => false,
                ],
                'content' => [
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'Item one',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'Item two',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Ordered List:',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'ordered_list',
                'attrs' => [
                    'order' => 1,
                    'tight' => false,
                ],
                'content' => [
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'Item one',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'Item two',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 2,
                ],
                'content' => [
                    [
                        'text' => 'Formats',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Lorem ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'ipsum dolor',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'code',
                            ],
                        ],
                    ],
                    [
                        'text' => ' sit amet, consectetur adipiscing elit. ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'Vestibulum',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'bold',
                            ],
                        ],
                    ],
                    [
                        'text' => ' sem ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'nisi',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'italic',
                            ],
                        ],
                    ],
                    [
                        'text' => ', imperdiet non ultricies at, luctus sit amet nisi.',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'A link to Vue.js website',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'link',
                                'attrs' => [
                                    'href' => 'https://vuejs.org',
                                    'title' => null,
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'image',
                        'attrs' => [
                            'alt' => 'This is the Vue.js logo',
                            'src' => 'https://vuejs.org/images/logo.png',
                            'title' => null,
                        ],
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                ],
                'content' => [
                    [
                        'text' => 'this is an example of fence',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'code_block',
                'attrs' => [
                    'params' => 'js',
                ],
                'content' => [
                    [
                        'text' => "const world = 'Hello'",
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => 1,
                ],
                'content' => [
                    [
                        'text' => 'nested lists',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'bullet_list',
                'attrs' => [
                    'tight' => false,
                ],
                'content' => [
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'list item',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                            [
                                'type' => 'bullet_list',
                                'attrs' => [
                                    'tight' => false,
                                ],
                                'content' => [
                                    [
                                        'type' => 'list_item',
                                        'content' => [
                                            [
                                                'type' => 'paragraph',
                                                'content' => [
                                                    [
                                                        'text' => 'internal list item',
                                                        'type' => 'text',
                                                    ],
                                                ],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => 'another list item',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function textWithMissingAttrs()
  {
    return [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'paragraph',
                    'content' => [
                        [
                            'text' => 'Text with ',
                            'type' => 'text',
                        ],
                        [
                            'text' => 'highlight',
                            'type' => 'text',
                            'marks' => [
                                [
                                    'type' => 'highlight',
                                    'attrs' => [
                                        'color' => '',
                                    ],
                                ],
                            ],
                        ],
                        [
                            'text' => ' colors. And another text ',
                            'type' => 'text',
                        ],
                        [
                            'text' => 'with text',
                            'type' => 'text',
                            'marks' => [
                                [
                                    'type' => 'textStyle',
                                    'attrs' => [
                                        'color' => null,
                                    ],
                                ],
                            ],
                        ],
                        [
                            'text' => ' color.',
                            'type' => 'text',
                        ],
                    ],
                ],
            ],
        ];
  }

  public static function textWithBrokenAttrs()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Text with ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'highlight',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'highlight',
                                'attrs' => [
                                    'color' => null,
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => ' colors. And another text ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'with text',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'textStyle',
                                'attrs' => [],
                            ],
                        ],
                    ],
                    [
                        'text' => ' color.',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Text with ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'highlight',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'highlight',
                                'attrs' => [
                                    'color' => null,
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => ' colors. And another text ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'with text',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'textStyle',
                            ],
                        ],
                    ],
                    [
                        'text' => ' color.',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
    ];
  }

  public static function textWithLinksSubscriptsAndSuperscripts()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'bold',
                            ],
                        ],
                        'text' => 'Lorem Ipsum',
                    ],
                    [
                        'type' => 'text',
                        'text' => ' is simply dummy text of the ',
                    ],
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'link',
                                'attrs' => [
                                    'href' => 'test.com',
                                    'uuid' => null,
                                    'linktype' => 'url',
                                    'target' => '_self',
                                    'anchor' => null,
                                    'custom' => [
                                        'title' => 'test one',
                                        'rel' => 'test two',
                                    ],
                                ],
                            ],
                        ],
                        'text' => 'printing and typesetting industry',
                    ],
                    [
                        'type' => 'text',
                        'text' => ". Lorem Ipsum has been the industry's standard dummy text ever since the ",
                    ],
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'superscript',
                            ],
                        ],
                        'text' => '1500s',
                    ],
                    [
                        'type' => 'text',
                        'text' => ', when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the ',
                    ],
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'subscript',
                            ],
                        ],
                        'text' => '1960s',
                    ],
                    [
                        'type' => 'text',
                        'text' => ' with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like ',
                    ],
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'superscript',
                            ],
                        ],
                        'text' => 'Aldus PageMaker',
                    ],
                    [
                        'type' => 'text',
                        'text' => ' including versions of ',
                    ],
                    [
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'subscript',
                            ],
                        ],
                        'text' => 'Lorem Ipsum',
                    ],
                    [
                        'type' => 'text',
                        'text' => '.',
                    ],
                ],
            ],
        ],
    ];
  }

  public static function escapeHTMLMarksFromText()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Simple phrases to test escapes:',
                        'type' => 'text',
                    ],
                ],
            ],
            [
                'type' => 'bullet_list',
                'content' => [
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => "A dummy apostrophe's test",
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => '<p>Just a tag</p>',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                    [
                        'type' => 'list_item',
                        'content' => [
                            [
                                'type' => 'paragraph',
                                'content' => [
                                    [
                                        'text' => '<p>Dummy & test</p>',
                                        'type' => 'text',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function escapeAmpersandInAttributeValues()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'test',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => "link",
                                'attrs' => [
                                    'href' => "https://www.storyblok.com/?foo=bar&bar=foo",
                                    'uuid' => null,
                                    'anchor' => null,
                                    'target' => "_self",
                                    'linktype' => "url",
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function h1WithAnchorInTheMiddleOfText()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'heading',
                'attrs' => [
                    'level' => '1',
                ],
                'content' => [
                    [
                        'text' => 'Title with ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'Anchor',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'anchor',
                                'attrs' => [
                                    'id' => 'test1',
                                ],
                            ],
                        ],
                    ],
                    [
                        'text' => ' in the midle',
                        'type' => 'text',
                    ],
                ],
            ],
        ],
    ];
  }

  public static function customAttrsInLinks()
  {
    return [
        'type' => 'paragraph',
        'content' => [
            [
                'text' => 'A nice link with custom attr',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => 'www.storyblok.com',
                            'uuid' => '300aeadc-c82d-4529-9484-f3f8f09cf9f5',
                            'anchor' => null,
                            'custom' => [
                                'rel' => 'nofollow',
                                'title' => 'nice test',
                            ],
                            'target' => '_blank',
                            'linktype' => 'url',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function textWithAnchor()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Paragraph with anchor in the middle',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'anchor',
                                'attrs' => [
                                    'id' => 'test',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function linkTagWithAnchor()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'text' => 'link text',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => '/link',
                            'target' => '_blank',
                            'title' => 'Any title',
                            'anchor' => 'anchor-text',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function linkTagWithStory()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'text' => 'link text',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => '/link',
                            'uuid' => '0fe06b7d-03d8-4d66-8976-9f7febace056',
                            'target' => '_self',
                            'linktype' => 'story',
                            'anchor' => 'anchor-text',
                            'story' => [
                                '_uid' => 'b94a6a90-1bd4-4ee0-ac14-a09310bd6a45',
                                'component' => 'page',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function linkTagWithoutAnchorButWithCssClass()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'text' => 'link text',
                'type' => 'text',
                'marks' => [
                    [
                        'type' => 'link',
                        'attrs' => [
                            'href' => '/link',
                            'target' => '_blank',
                            'title' => 'Any title',
                            'anchor' => '',
                        ],
                    ],
                    [
                        'type' => 'styled',
                        'attrs' => [
                            'class' => 'css__class',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function paragraphWithClassAttribute()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Storyblok visual editor is ',
                        'type' => 'text',
                    ],
                    [
                        'text' => 'awesome!',
                        'type' => 'text',
                        'marks' => [
                            [
                                'type' => 'styled',
                                'attrs' => [
                                    'class' => 'highlight',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function emojiWithFallbackImage()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Text with an emoji in the end ',
                        'type' => 'text',
                    ],
                    [
                        'type' => 'emoji',
                        'attrs' => [
                            'name' => 'trollface',
                            'emoji' => null,
                            'fallbackImage' => 'https://github.githubassets.com/images/icons/emoji/trollface.png',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }

  public static function textWithEmoji()
  {
    return [
        'type' => 'doc',
        'content' => [
            [
                'type' => 'paragraph',
                'content' => [
                    [
                        'text' => 'Text with an emoji in the end ',
                        'type' => 'text',
                    ],
                    [
                        'type' => 'emoji',
                        'attrs' => [
                            'name' => 'smile',
                            'emoji' => '😄',
                            'fallbackImage' => 'https://cdn.jsdelivr.net/npm/emoji-datasource-apple/img/apple/64/1f604.png',
                        ],
                    ],
                ],
            ],
        ],
    ];
  }
}