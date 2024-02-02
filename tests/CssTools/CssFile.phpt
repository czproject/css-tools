<?php

declare(strict_types=1);

use CzProject\CssTools;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('Basic', function () {
	$file = new CssTools\CssFile;
	$file->addRule('.button', [
		'color' => CssTools\Color::hex('#F8A'),
		'font-size' => CssTools\Number::px2rem(48),
		'background-color' => NULL,
	]);

	$file->addRule('.empty-rule');

	Assert::same(implode("\n", [
		'.button {',
		'color: #F8A;',
		'font-size: 3rem;',
		"}\n",
	]), $file->render());
});
