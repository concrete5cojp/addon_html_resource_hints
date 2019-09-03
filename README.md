# Html Resourse Hints
A concrete5 add-on to insert HTML resource hints

## Summary

- **dns-prefetch**: To indicate an origin that will be used to fetch required resources. We suggest using this on things such as Google fonts, Google Analytics, and your CDN.
- **preconnect**: To setup early connections before making an HTML request, which includes the DNS lookup, TCP handshake, and optional TLS negotiation. Consider using preconnect when you know for sure that you’re going to be accessing a resource and you want get ahead.
- **preload**: Generally it is best to preload your most important resources such as images, CSS, JavaScript, and font files.
- **Prefetch**: To fetch & cache the resource for next possible navigation.
- **Prerender**:  To fetch & execute the resource for next possible navigation.

Learn more-

- https://www.w3.org/TR/resource-hints/
- https://www.keycdn.com/blog/resource-hints
- https://www.smashingmagazine.com/2019/04/optimization-performance-resource-hints/



## How To Use

An example to insert resource hint

```
/** @var \HtmlResourceHints\Html\Service\Resource $resource */
$resource = Core::make('html/resource');
$resource->preload('/assets/font.woff2', ['as' => 'font', 'type' => 'font/woff2']);
$resource->preload('style/other.css', ['as' => 'style']);
$resource->preload('//example.com/resource', ['as' => 'fetch', 'crossorigin' => true]);
$resource->preload('https://fonts.example.com/font.woff2', ['as' => 'font', 'crossorigin' => true, 'type' => 'font/woff2']);
$resource->dnsPrefetch('//widget.com');
$resource->preconnect('//cdn.example.com');
$resource->prerender('//example.com/next-page.html');
$resource->prefetch('//example.com/logo-hires.jpg', ['as' => 'image']);
```

Output-

```
<link rel="preload" href="/assets/font.woff2" as="font" type="font/woff2">
<link rel="preload" href="/style/other.css" as="style">
<link rel="preload" href="//example.com/resource" as="fetch" crossorigin>
<link rel="preload" href="https://fonts.example.com/font.woff2" as="font" crossorigin type="font/woff2">
<link rel="dns-prefetch" href="//widget.com">
<link rel="preconnect" href="//cdn.example.com">
<link rel="prerender" href="//example.com/next-page.html">
<link rel="prefetch" href="//example.com/logo-hires.jpg" as="image">
```

## License

MIT