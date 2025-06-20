# CzProject\CssTools

[![Build Status](https://github.com/czproject/css-tools/workflows/Build/badge.svg)](https://github.com/czproject/css-tools/actions)
[![Downloads this Month](https://img.shields.io/packagist/dm/czproject/css-tools.svg)](https://packagist.org/packages/czproject/css-tools)
[![Latest Stable Version](https://poser.pugx.org/czproject/css-tools/v/stable)](https://github.com/czproject/css-tools/releases)
[![License](https://img.shields.io/badge/license-New%20BSD-blue.svg)](https://github.com/czproject/css-tools/blob/master/license.md)

CSS tools for PHP.

<a href="https://www.janpecha.cz/donate/"><img src="https://buymecoffee.intm.org/img/donate-banner.v1.svg" alt="Donate" height="100"></a>


## Installation

[Download a latest package](https://github.com/czproject/css-tools/releases) or use [Composer](http://getcomposer.org/):

```
composer require czproject/css-tools
```

CzProject\CssTools requires PHP 8.0 or later.


## Usage

### CSS compiler

Expands `@import` rules in file.

``` php
$compiler = new CzProject\CssTools\CssCompiler;
$compiler->compileFile(__DIR__ . '/styles.css'); // overwrite styles.css with compiled version
$compiledStyles = $compiler->processFile(__DIR__ . '/styles2.css');
$compiledStyles = $compiler->processContent(
	'@import "mystyles.css";',
	$stylesheetsRootDirectory
);
```

### CSS generator
``` php
$file = new CzProject\CssTools\CssFile;
$file->addRule('.button', [
	'color' => CssTools\Color::hex('#F8A'),
	'font-size' => CssTools\Number::px2rem(48),
	'background-color' => NULL,
]);

echo $file->render();
```

### CSS minifier

``` php
$minifier = new CzProject\CssTools\CssMinifier;
$result = $minifier->minify("body {
	color: #333;
	background: #fff;
}");
var_dump($result); // Output: body{color:#333;background:#fff}
```

------------------------------

License: [New BSD License](license.md)
<br>Author: Jan Pecha, https://www.janpecha.cz/
