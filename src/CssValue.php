<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	interface CssValue
	{
		function render(): string;
	}
