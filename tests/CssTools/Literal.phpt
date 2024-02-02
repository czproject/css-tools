<?php

declare(strict_types=1);

use CzProject\CssTools;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('Basic', function () {
	Assert::same('top left', (new CssTools\Literal('top left'))->render());
});
