CHANGELOG
=========

## v3.0.0

### Changes

* The Markdownify(_Extra) classes have been replaced by the
  [Markdownify library](https://github.com/Pixel418/Markdownify)
* An `markdownify` alias has been added for `pk.markdownify`.
  This is the preferred service id to use, as I'm thinking about
  deprecating and dropping the `pk` prefix entirely in a later
  version.

### Breaking changes

* The namespace for the Markdownify classes have changed
  from `\PK\MarkdownifyBundle\Markdownify` to `\Markdownify`
* The classes `Markdownify` and `MarkdownifyExtra` are now
  named `Converter` and `ConverterExtra`, as per the updated
  library.
