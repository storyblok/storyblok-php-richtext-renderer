<?php

use PHPUnit\Framework\TestCase;
use Storyblok\RichtextRender\Fixtures\ResolverTestData;
use Storyblok\RichtextRender\Resolver;

final class RenderOptmizedImagesTest extends TestCase
{
    protected static $resolver;
    protected static $data;

    public static function setUpBeforeClass(): void
    {
        self::$resolver = new Resolver();

        self::$data = ResolverTestData::imageStoredAtStoryblokAssets();
    }

    public function testCanRenderImageAtStoryblokAssets()
    {
        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data));
    }

    public function testCanGenerateImgTagWithOptimization()
    {
        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, ['optimizeImages' => true]));
    }

    public function testCanGenerateImgTagWithOptimizationAndLoadingLazy()
    {
        $options = ['optimizeImages' => ['loading' => 'lazy']];

        $expected = '<img loading="lazy" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndWidth()
    {
        $options = ['optimizeImages' => ['width' => 500]];

        $expected = '<img width="500" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/500x0" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndHeight()
    {
        $options = ['optimizeImages' => ['height' => 350]];

        $expected = '<img height="350" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x350" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndCustomClasses()
    {
        $options = ['optimizeImages' => ['class' => 'w-full my-8']];

        $expected = '<img class="w-full my-8" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['class' => '']];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndBlurFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['blur' => 10]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:blur(10)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndBrightnessFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['brightness' => 15]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:brightness(15)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndFillFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['fill' => 'transparent']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:fill(transparent)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['fill' => 'FFCC99']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:fill(FFCC99)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['fill' => 'INVALID']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndFormatFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['format' => 'png']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:format(png)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['format' => 'webp']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:format(webp)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['format' => 'jpeg']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:format(jpeg)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['format' => 'INVALID']]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndGrayscaleFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['grayscale' => true]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:grayscale()" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndQualityFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['quality' => 90]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:quality(90)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['quality' => -90]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['quality' => 101]]];

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndRotateFilter()
    {
        $options = ['optimizeImages' => ['filters' => ['rotate' => 90]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:rotate(90)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['rotate' => 180]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:rotate(180)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['rotate' => 270]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:rotate(270)" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['filters' => ['rotate' => 9999999]]];

        $expected = '<img src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndSrcset()
    {
        $options = ['optimizeImages' => ['srcset' => [360, 1024, 1500]]];

        $expected = '<img srcset="//a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/360x0 360w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1024x0 1024w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1500x0 1500w" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

        $options = ['optimizeImages' => ['srcset' => [[360, 360], 1024, 1500]]];

        $expected = '<img srcset="//a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/360x360 360w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1024x0 1024w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1500x0 1500w" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));

    }

    public function testCanGenerateImgTagWithOptimizationAndSrcsetAndFilterAndLoadingLazy()
    {
        $options = ['optimizeImages' => ['loading' => 'lazy', 'filters' => ['grayscale' => true], 'srcset' => [[360, 360], [1024, 768], 1500]]];

        $expected = '<img srcset="//a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/360x360/filters:grayscale() 360w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1024x768/filters:grayscale() 1024w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1500x0/filters:grayscale() 1500w" loading="lazy" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:grayscale()" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndSizes()
    {
        $options = ['optimizeImages' => ['sizes' => ['(max-width: 767px) 100vw', '(max-width: 1024px) 768px', '1500px']]];

        $expected = '<img sizes="(max-width: 767px) 100vw, (max-width: 1024px) 768px, 1500px" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testCanGenerateImgTagWithOptimizationAndSrcsetAndSizesAndFilterAndLoadingLazy()
    {
        $options = ['optimizeImages' => ['loading' => 'lazy', 'filters' => ['grayscale' => true], 'srcset' => [[360, 360], [1024, 768], 1500], 'sizes' => ['(max-width: 767px) 100vw', '(max-width: 1024px) 768px', '1500px']]];

        $expected = '<img srcset="//a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/360x360/filters:grayscale() 360w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1024x768/filters:grayscale() 1024w, //a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/1500x0/filters:grayscale() 1500w" sizes="(max-width: 767px) 100vw, (max-width: 1024px) 768px, 1500px" loading="lazy" src="https://a.storyblok.com/f/000000/00a00a00a0/image-name.png/m/0x0/filters:grayscale()" alt="Alt text" />';

        self::assertSame($expected, self::$resolver->render((object) self::$data, $options));
    }

    public function testShouldSkipImgTagWithOptimizationAndSrcsetWhenImageIsNotInStoryblokAsset()
    {

        $data = [
            'type' => 'doc',
            'content' => [
                [
                    'type' => 'image',
                    'attrs' => [
                        'src' => 'https://vuejs.org/images/logo.png',
                        'alt' => 'This is the Vue.js logo',
                    ],
                ],
            ],
        ];

        $options = ['optimizeImages' => ['srcset' => [360, 1024, 1500]]];

        $expected = '<img src="https://vuejs.org/images/logo.png" alt="This is the Vue.js logo" />';

        self::assertSame($expected, self::$resolver->render((object) $data, $options));

    }
}
