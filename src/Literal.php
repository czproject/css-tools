<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class Literal implements CssValue
	{
		/** @var string */
		private $literal;


		public function __construct(string $literal)
		{
			$this->literal = $literal;
		}


		public function render(): string
		{
			return $this->literal;
		}
	}
