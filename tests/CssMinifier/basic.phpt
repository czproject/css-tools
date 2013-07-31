<?php
use Tester\Assert;

require __DIR__ . '/bootstrap.php';
require __DIR__ . '/../../src/CssMinifier.php';


$minifier = new Cz\CssMinifier\CssMinifier;

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

