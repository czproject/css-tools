<?php

declare(strict_types=1);

use CzProject\CssTools;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


test('Same size', function () {
	Assert::same('1rem', (new CssTools\FluidSize(16, 16, 320, 1240))->render());
});


test('Same width', function () {
	Assert::same('2rem', (new CssTools\FluidSize(16, 32, 320, 320))->render());
	Assert::same('2rem', (new CssTools\FluidSize(32, 16, 320, 320))->render());
});


test('Fluiding', function () {
	Assert::same('clamp(0.75rem, -0.163rem + 4.5652vi, 3.375rem)', (new CssTools\FluidSize(12, 54, 320, 1240))->render());
	Assert::same('clamp(3rem, 2.8696rem + 0.6522vi, 3.375rem)', (new CssTools\FluidSize(48, 54, 320, 1240))->render());
	Assert::same('clamp(2rem, 0.625rem + 6.875vi, 3.375rem)', (new CssTools\FluidSize(32, 54, 320, 640))->render());
});


test('Fluiding - negative', function () {
	Assert::same('clamp(0.75rem, 4.288rem + -4.5652vi, 3.375rem)', (new CssTools\FluidSize(54, 12, 320, 1240))->render());
	Assert::same('clamp(3rem, 3.5054rem + -0.6522vi, 3.375rem)', (new CssTools\FluidSize(54, 48, 320, 1240))->render());
	Assert::same('clamp(2rem, 4.75rem + -6.875vi, 3.375rem)', (new CssTools\FluidSize(54, 32, 320, 640))->render());
});
