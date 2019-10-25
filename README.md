# Storyblok PHP Richtext Renderer

This package allows you to get an HTML string from the [richtext field](https://www.storyblok.com/docs/richtext-field) of Storyblok.

### Install dependecies

```shell
composer require storyblok/richtext-resolver dev-master
```
### Usage:

Instantiate the `Resolver` class:

```php
use Storyblok\RichtextRender\Resolver;

$resolver = new Resolver();

```

Use the function `render()` to get the html string from your richtext field.

```php
// previous code...

// Note that in php our objects use multidimensional array notation
$data = [
  "type" => "doc",
  "content" => [
    [
      "type" => "horizontal_rule"
    ]
  ]
];

$resolver->render($data) # renders a html string: '<hr />'
```

### How to define a custom schema for resolver?

Make a copy of the default schema [storyblok-php-richtext-renderer/src/Schema.php](https://github.com/storyblok/storyblok-php-richtext-renderer/blob/master/src/Schema.php) and add your own schema as parameter to the Richtext class.

```py
$resolver = new Resolver($my_custom_schema);
```

#### Testing

We use phpunit for tests. You can execute the following task to run the tests:

```bash 
composer run test
```

## Contribution

Fork me on [Github](https://github.com/storyblok/storyblok-php-richtext-renderer)
