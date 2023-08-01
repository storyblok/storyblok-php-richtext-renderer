<?php

/** @noinspection HtmlUnknownAttribute */

/** @noinspection HtmlDeprecatedTag */

namespace Storyblok\RichtextRender;

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Fixtures\ResolverTestData;

/**
 * @internal
 *
 * @coversNothing
 */
final class ResolverTest extends TestCase
{
    public function testRenderSpanWithClassAttribute()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::spanWithClassAttribute();

        $expected = '<span class="red">red text</span>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderHrTag()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'horizontal_rule',
                ],
            ],
        ];

        $expected = '<hr />';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderImgTag()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'image',
                    'attrs' => [
                        'src' => 'https://asset',
                        'alt' => 'Any description',
                    ],
                ],
            ],
        ];

        $expected = '<img src="https://asset" alt="Any description" />';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderLinkTag()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::linkTag();

        $expected = '<a href="/link" target="_blank" title="Any title">link text</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderLinkTagWithCustomAttributes()
    {
        $resolver = new Resolver();

        $data = [
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
                                'custom' => [
                                    'rel' => 'alternate',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $expected = '<a href="/link" target="_blank" title="Any title" rel="alternate">link text</a>';

        self::assertSame($resolver->render((object) $data), $expected);
    }

    public function testRenderLinkTagWithEmptyCustomAttributesArrayShouldNotCauseErrors()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::linkTagWithEmptyCustomAttributes();

        $expected = '<a href="/link" target="_blank" title="Any title">link text</a>';

        self::assertSame($resolver->render((object) $data), $expected);
    }

    public function testRenderLinkTagWithEmail()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::linkTagWithEmail();

        $expected = '<a href="mailto:email@client.com" target="_blank" title="Any title">an email link</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderTagWithNullAttribute()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::tagWithNullAttribute();

        $expected = '<a href="/link" target="_blank">link text</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderCodeTag()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'code_block',
                    'content' => [
                        [
                            'text' => 'code',
                            'type' => 'text',
                        ]],
                ]],
        ];

        $expected = '<pre><code>code</code></pre>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderHeadingTag()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [[
                'type' => 'heading',
                'attrs' => [
                    'level' => 2,
                ],
                'content' => [[
                    'text' => 'Lorem ipsum',
                    'type' => 'text',
                ]],
            ]],
        ];
        $expected = '<h2>Lorem ipsum</h2>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderHeadingTagWhithoutLevel()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [[
                'type' => 'heading',
                'content' => [[
                    'text' => 'Lorem ipsum',
                    'type' => 'text',
                ]],
            ]],
        ];
        $expected = '<h1>Lorem ipsum</h1>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderBulletList()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::bulletList();

        $expected = '<ul><li><p>Item 1</p></li><li><p>Item 2</p></li><li><p>Item 3</p></li></ul>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderOrderedList()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::orderedList();

        $expected = '<ol><li><p>Item 1</p></li><li><p>Item 2</p></li><li><p>Item 3</p></li></ol>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderComplexRender()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::complexData();

        $expected = '<p>Lorem <strike>ipsum</strike> dolor sit amet, <b>consectetur</b> <u>adipiscing</u> elit. Duis in <code>sodales</code> metus. Sed auctor, tellus in placerat aliquet, arcu neque efficitur libero, non euismod <i>metus</i> orci eu erat</p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderCustomSchema()
    {
        $custom = [
            'nodes' => [
                'paragraph' => $this->getTag('p'),
            ],
            'marks' => [
                'strike' => $this->getTag('strike'),
            ],
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
                        'type' => 'strike',
                    ]],
                ]],
            ]],
        ];

        $expected = '<p>some text after <strike>strike text</strike></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderCustomSchemaWithoutMarks()
    {
        $custom = [
            'nodes' => [
                'paragraph' => $this->getTag('p'),
            ],
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
                        'type' => 'strike',
                    ]],
                ]],
            ]],
        ];

        $expected = '<p>some text after strike text</p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderLinkTagWithAnchor()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::linkTagWithAnchor();

        $expected = '<a href="/link#anchor-text" target="_blank" title="Any title">link text</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderLinkTagWithStory()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::linkTagWithStory();

        $expected = '<a href="/link#anchor-text" target="_self">link text</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderLinkTagWithoutAnchor()
    {
        $resolver = new Resolver();

        $data = [
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
                    ],
                ],
            ],
        ];

        $expected = '<a href="/link" target="_blank" title="Any title">link text</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderLinkTagWithoutAnchorButWithCssClass()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::linkTagWithoutAnchorButWithCssClass();

        $expected = '<a href="/link" target="_blank" title="Any title"><span class="css__class">link text</span></a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderParagraphWithClassAttribute()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::paragraphWithClassAttribute();

        $expected = '<p>Storyblok visual editor is <span class="highlight">awesome!</span></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderParagraphWithThreeClassAttribute()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::paragraphWithThreeClassAttribute();

        $expected = '<p>This is a <span class="test">awesome</span> text and this <span class="red">renderer</span> is built with <span class="test__red">php.</span></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testFullText()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::fullText();

        $expected = '<h1>Heading one</h1><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum sem nisi, imperdiet non ultricies at, luctus sit amet nisi.</p><h2>Heading two</h2><p>Aliquam consectetur sem et convallis hendrerit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; In tincidunt placerat velit vel lobortis.</p><h3>Heading three</h3><p>Suspendisse ultricies urna arcu, id tincidunt nibh posuere ut. Nunc dapibus, tellus sit amet fermentum eleifend, risus augue pretium massa, a imperdiet tortor ante placerat diam.</p><h4>Heading four</h4><p>Fusce non vehicula eros. Duis diam orci, efficitur porta mauris et, porttitor aliquet nisl.</p><h5>Heading five</h5><p>Integer quis euismod nulla. Nam dapibus maximus nisi, in tempor ante consequat ac. Vestibulum rutrum hendrerit ex, ac dapibus dui finibus id. Praesent molestie dictum neque vel lobortis</p><h6>Heading six</h6><p>Proin congue felis faucibus, volutpat lorem non, imperdiet lacus. Curabitur sed mattis tellus. Maecenas at aliquam odio</p><hr /><h1>More examples to another tags</h1><h2>Blockquote</h2><blockquote><p>This is an example of blockquote</p></blockquote><h2>Lists</h2><p>Unordered List:</p><ul><li><p>Item one</p></li><li><p>Item two</p></li></ul><p>Bullet List:</p><ul><li><p>Item one</p></li><li><p>Item two</p></li></ul><p>Ordered List:</p><ol><li><p>Item one</p></li><li><p>Item two</p></li></ol><h2>Formats</h2><p>Lorem <code>ipsum dolor</code> sit amet, consectetur adipiscing elit. <b>Vestibulum</b> sem <i>nisi</i>, imperdiet non ultricies at, luctus sit amet nisi.</p><p><a href="https://vuejs.org">A link to Vue.js website</a></p><p><img alt="This is the Vue.js logo" src="https://vuejs.org/images/logo.png" /></p><h1>this is an example of fence</h1><pre><code params="js">const world = &#039;Hello&#039;</code></pre><h1>nested lists</h1><ul><li><p>list item</p><ul><li><p>internal list item</p></li></ul></li><li><p>another list item</p></li></ul>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderSubscript()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'paragraph',
            'content' => [
                [
                    'text' => 'A Subscript text',
                    'type' => 'text',
                    'marks' => [
                        [
                            'type' => 'subscript',
                        ],
                    ],
                ],
            ],
        ];

        $expected = '<sub>A Subscript text</sub>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderSuperscript()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'paragraph',
            'content' => [
                [
                    'text' => 'A superscript text',
                    'type' => 'text',
                    'marks' => [
                        [
                            'type' => 'superscript',
                        ],
                    ],
                ],
            ],
        ];

        $expected = '<sup>A superscript text</sup>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testTextWithEmoji()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::textWithEmoji();

        $expected = '<p>Text with an emoji in the end <span data-type="emoji" data-name="smile" emoji="😄">😄</span></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testEmojiWithFallbackImage()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::emojiWithFallbackImage();

        $expected = '<p>Text with an emoji in the end <span data-type="emoji" data-name="trollface"><img src="https://github.githubassets.com/images/icons/emoji/trollface.png" draggable="false" loading="lazy" align="absmiddle" /></span></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testHighlightColor()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [
                [
                    'text' => 'Highlighted text',
                    'type' => 'text',
                    'marks' => [
                        [
                            'type' => 'highlight',
                            'attrs' => [
                                'color' => '#E72929',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $expected = '<span style="background-color:#E72929;">Highlighted text</span>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testTextWithColor()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
            'content' => [
                [
                    'text' => 'Colored text',
                    'type' => 'text',
                    'marks' => [
                        [
                            'type' => 'textStyle',
                            'attrs' => [
                                'color' => '#E72929',
                            ],
                        ],
                    ],
                ],
            ],
        ];

        $expected = '<span style="color:#E72929">Colored text</span>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testTextWithAnchor()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::textWithAnchor();

        $expected = '<p><span id="test">Paragraph with anchor in the middle</span></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testWithCustomAttrsInLinks()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::customAttrsInLinks();

        $expected = '<a href="www.storyblok.com" uuid="300aeadc-c82d-4529-9484-f3f8f09cf9f5" target="_blank" rel="nofollow" title="nice test">A nice link with custom attr</a>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testH1WithAnchorInTheMiddleOfText()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::h1WithAnchorInTheMiddleOfText();

        $expected = '<h1>Title with <span id="test1">Anchor</span> in the midle</h1>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testBoldText()
    {
        $resolver = new Resolver();

        $data = [
            'type' => 'doc',
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
            ],
        ];

        $expected = '<b>Lorem Ipsum</b>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderTextWithMissingAttrs()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::textWithMissingAttrs();

        $expected = '<p>Text with highlight colors. And another text with text color.</p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testRenderTextWithBrokenAttrs()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::textWithBrokenAttrs();

        $expected = '<p>Text with highlight colors. And another text with text color.</p><p>Text with highlight colors. And another text with text color.</p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testTextWithLinksSubscriptsAndSuperscripts()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::textWithLinksSubscriptsAndSuperscripts();

        $expected = '<p><b>Lorem Ipsum</b> is simply dummy text of the <a href="test.com" target="_self" title="test one" rel="test two">printing and typesetting industry</a>. Lorem Ipsum has been the industry&#039;s standard dummy text ever since the <sup>1500s</sup>, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the <sub>1960s</sub> with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like <sup>Aldus PageMaker</sup> including versions of <sub>Lorem Ipsum</sub>.</p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testEscapeHTMLMarksFromText()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::escapeHTMLMarksFromText();

        $expected = '<p>Simple phrases to test escapes:</p><ul><li><p>A dummy apostrophe&#039;s test</p></li><li><p>&lt;p&gt;Just a tag&lt;/p&gt;</p></li><li><p>&lt;p&gt;Dummy &amp; test&lt;/p&gt;</p></li></ul>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    public function testEscapeAmpersandInAttributeValues()
    {
        $resolver = new Resolver();

        $data = ResolverTestData::escapeAmpersandInAttributeValues();

        $expected = '<p><a href="https://www.storyblok.com/?foo=bar&amp;bar=foo" target="_self">test</a></p>';

        self::assertSame($expected, $resolver->render((object) $data));
    }

    private function getTag($tag)
    {
        return static function () use ($tag) {
            return [
                'tag' => $tag,
            ];
        };
    }
}
