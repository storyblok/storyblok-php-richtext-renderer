> [!WARNING]  
> This package is discontinued and will only receive critical security updates.\
> Please use the new official [Tiptap Extension](https://github.com/storyblok/php-tiptap-extension).

# Storyblok PHP Richtext Renderer - Deprecated

This package allows you to get an HTML string from the [richtext field](https://www.storyblok.com/docs/richtext-field) of Storyblok.

## Installing the Storyblok PHP Richtext Renderer
You can install the Storyblok PHP Richtext Renderer via composer.
Storyblok PHP Richtext Renderer requires PHP version 7.3 to 8.2. The suggestion is to use an actively supported version of PHP (8.1 and 8.2).

If you want to install the stable release of Storyblok PHP Richtext Renderer you can launch:

```shell
composer require storyblok/richtext-resolver
```

If you want to install the current development release, you can add the version `dev-master`:

```shell
composer require storyblok/richtext-resolver dev-master
```

For executing the command above, you need to have composer installed on your development environment. If you need to install Composer, you can follow the official Composer documentation:

- Install Composer on [GNU Linux / Unix / macOS](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos)
- Install Composer on [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows)

We suggest using the latest version of PHP.

```shell
composer require storyblok/richtext-resolver dev-master
```
## Usage:

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

```php
$resolver = new Resolver($my_custom_schema);
```

## Testing

We use PHPUnit for tests. You can execute the following composer task to run the tests:

```bash
composer run test
```

If you want to generate the coverage report you can launch:

```bash
composer run test-coverage
```
You will find the HTML reports in the `coverage/` directory.


## Code Style guide

For consistency, we are using [PHP Coding Standards Fixer](https://github.com/PHP-CS-Fixer/PHP-CS-Fixer) tool, for checking and fixing the code to follow standards.

For checking the code you can execute:

```
composer run codestyle-check
```

If you want to automatically fix the code to follow standards:

```
composer run codestyle-fix
```

If you want to execute fix and test coverage:
```
composer run all-check
```


## Contribution

Fork me on [Github](https://github.com/storyblok/storyblok-php-richtext-renderer)
