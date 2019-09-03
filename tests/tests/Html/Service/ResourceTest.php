<?php
/**
 * Class ResourceTest.
 *
 * @author: Biplob Hossain <biplob@concrete5.co.jp>
 *
 * @license MIT
 * Date: 2019/08/30
 */
namespace HtmlResourceHints\Tests\Html\Service;

use HtmlResourceHints\Html\Service\Resource;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

class ResourceTest extends TestCase
{
    /** @var MockObject | Resource  */
    protected $object;

    public function setUp()
    {
        $this->object = $this->getMockBuilder(Resource::class)
            ->setMethods(['insertTag',])
            ->getMock();
    }

    public function getTagDataProvider(): array 
    {
        return [
            ['<link rel="preload" href="/assets/font.woff2" as="font" type="font/woff2">', 'preload', '/assets/font.woff2', ['as' => 'font', 'type' => 'font/woff2']],
            ['<link rel="preload" href="/style/other.css" as="style">', 'preload', '/style/other.css', ['as' => 'style']],
            ['<link rel="preload" href="//example.com/resource" as="fetch" crossorigin>', 'preload', '//example.com/resource', ['as' => 'fetch', 'crossorigin' => true]],
            ['<link rel="preload" href="https://fonts.example.com/font.woff2" as="font" crossorigin type="font/woff2">', 'preload', 'https://fonts.example.com/font.woff2', ['as' => 'font', 'crossorigin' => true, 'type' => 'font/woff2']],
            ['<link rel="prerender" href="//example.com/next-page.html">', 'prerender', '//example.com/next-page.html', null],
            ['<link rel="preconnect" href="//cdn.example.com">', 'preconnect', '//cdn.example.com', null],
            ['<link rel="prerender" href="//example.com/next-page.html">', 'prerender', '//example.com/next-page.html', null],
            ['<link rel="dns-prefetch" href="//widget.com">', 'dns-prefetch', '//widget.com', null],
            ['<link rel="prefetch" href="/example.com/logo-hires.jpg" as="image">', 'prefetch', '/example.com/logo-hires.jpg', ['as' => 'image']],
        ];
    }

    /**
     * @dataProvider getTagDataProvider
     *
     * @param $expected
     * @param $hint
     * @param $host
     * @param array $options
     */
    public function testGetTag($expected, $hint, $host, $options = []): void
    {
        $this->assertEquals($expected, $this->object->getTag($hint, $host, $options));
    }

    public function testPreload(): void
    {
        $this->object->expects($this->once())
            ->method('insertTag');
        $this->object->preload('//example.com/logo-hires.jpg', ['as' => 'image']);
    }

    public function testPrerender(): void
    {
        $this->object->expects($this->once())
            ->method('insertTag');
        $this->object->preload('//example.com/logo-hires.jpg', ['as' => 'image']);
    }

    public function testPreconnect(): void
    {
        $this->object->expects($this->once())
            ->method('insertTag');
        $this->object->preconnect('//cdn.example.com');
    }

    public function testDnsPrefetch(): void
    {
        $this->object->expects($this->once())
            ->method('insertTag');
        $this->object->dnsPrefetch('//widget.com');
    }

    public function testPrefetch(): void
    {
        $this->object->expects($this->once())
            ->method('insertTag');
        $this->object->prefetch('//example.com/logo-hires.jpg', ['as' => 'image']);
    }
}
