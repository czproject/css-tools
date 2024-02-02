<?php

declare(strict_types=1);

use CzProject\CssTools;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('Basic', function () {
	Assert::same('1.0625em', CssTools\Number::px2em(17)->render());
	Assert::same('1.1em', CssTools\Number::px2em(17, 1)->render());

	Assert::same('1.0625rem', CssTools\Number::px2rem(17)->render());
	Assert::same('1rem', CssTools\Number::px2rem(17, 0)->render());
});
