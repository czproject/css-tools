<?php

declare(strict_types=1);

use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


$minifier = new CzProject\CssTools\CssMinifier;

// Basic
Assert::same('body{color:#333;background:#fff}', $minifier->minify("body {
	color: #333;
	background: #fff;
}"));


// Remove comments & white space
Assert::same('.classname{font-weight:normal}', $minifier->minify("/*****
  Multi-line comment
  before a new class name
*****/
.classname {
    /* comment in declaration block */
    font-weight: normal;
}"));


// Remove last semicolon
Assert::same('.classname{border-top:1px;border-bottom:2px}', $minifier->minify(".classname {
    border-top: 1px;
    border-bottom: 2px;
}"));


// Remove extra last semicolon
Assert::same('.classname{border-top:1px;border-bottom:2px}', $minifier->minify(".classname {
    border-top: 1px; ;
    border-bottom: 2px;;;
}"));
