<?php

declare(strict_types=1);

use CzProject\CssTools;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('Basic', function () {
	Assert::same('#F8A', CssTools\Color::hex('#F8A')->render());
});
