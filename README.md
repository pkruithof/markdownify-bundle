MarkdownifyBundle
=================

[![Build Status](https://travis-ci.org/pkruithof/MarkdownifyBundle.svg)](https://travis-ci.org/pkruithof/MarkdownifyBundle)

Provides Symfony2 integration for the Markdownify/Markdownify_Extra scripts.

The original Markdownify from [Milian Wolff](http://milianw.de/projects/markdownify/)
has been refactored by myself (see [modifications](#modifications))
and later by [Pixel418](https://github.com/Pixel418/Markdownify).

The latter is now merged back into this bundle as a dependency, so that the
ongoing development in that repo is also available in this bundle.

## Requirements
The bundle is built for Symfony 2.3 and up. It should work on older versions,
but they are not supported.

## Installation
Install the bundle using composer:

### Automatically
```
php composer.phar require "pk/markdownify-bundle:~3.0"
```

### Manually
Add to `composer.json`:
```
"pk/markdownify-bundle": "~3.0"
```

and update:
```
php composer.phar update "pk/markdownify-bundle"
```

### AppKernel.php

Add to `app/AppKernel.php`:
```php
new PK\MarkdownifyBundle\PKMarkdownifyBundle()
```

### Configuration

The configuration is optional as all options have defaults.

```yaml
pk_markdownify:
  # Where to put the link references:
  # * 0 for after the content (default)
  # * 1 for after each paragraph
  # * 2 for in the paragraph, directly after the link text
  link_position: 0

  # When larger than the minimal width (25), the body will be
  # wrapped to this width. Set to false to disable wrapping (default)
  body_width: false

  # Whether to keep html tags which cannot be converted to markdown
  keep_html: false
```

## Usage
The bundle registers a `markdownify` service. Use it as you would use the Markdownify class:

```php
$converter = $container->get('markdownify');
$converter->parseString('<h1>Heading</h1>');
// Returns: # Heading
```

**NOTE**: Before version 3.0, the Markdownify classes were included in this bundle,
which had a different namespace than the `\Markdownify` one used currently. If you use
this namespace somewhere in your code, be sure to update them when upgrading to 3.0.


## Modifications
The following modifications have been applied to the original Markdownify code.

* PSR 0 to 2 coding standards fix
* Organised properties and methods (properties first, then methods)
