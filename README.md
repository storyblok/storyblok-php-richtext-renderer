# Storyblok PHP Richtext Renderer
The utility class for renderer HTML from Richtext component in Storyblok.

### Install dependecies

```shell
  composer install
```
### Usage:

Instantiate the `Resolver` class:

```php
use Storyblok\RichtextRender\Resolver;

  $resolver = new Resolver();

```
And now use the object with render() function...

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

  $resolver->render((object) $data) # renders a html string: '<hr />'
```


### How to define a custom schema for resolver ?
The Richtext class can be receive a single parameter called `Schema`. This parameter must be a dictionary with the two fields, `nodes` and `marks`. This fields can be dictionaries like as `storyblok-php-richtext-renderer/src/Schema.php` file.

#### Testing
We use phpunit module for tests. In terminal, execute:
```bash 
  composer run test
```

## Contribution

Fork me on [Github](https://github.com/storyblok/storyblok-php-richtext-renderer)