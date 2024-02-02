<?php

declare(strict_types=1);

use CzProject\CssTools;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('Full URL', function () {
	Assert::same('url(https\:\/\/example\.com\/image\.jpg)', (new CssTools\Url('https://example.com/image.jpg'))->render());
});


test('Schema-less URL', function () {
	Assert::same('url(\/\/example\.com\/image\.jpg)', (new CssTools\Url('//example.com/image.jpg'))->render());
});


test('Absolute path', function () {
	Assert::same('url(\/image\.jpg)', (new CssTools\Url('/image.jpg'))->render());
});


test('Relative path', function () {
	Assert::same('url(\.\.\/images\/image\.jpg)', (new CssTools\Url('../images/image.jpg'))->render());
});
