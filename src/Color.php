<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class Color implements CssValue
	{
		/** @var string */
		private $color;


		private function __construct(string $color)
		{
			$this->color = $color;
		}


		public function render(): string
		{
			return $this->color;
		}


		public static function hex(string $hex): self
		{
			return new self($hex);
		}
	}
