<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class Number implements CssValue
	{
		/** @var int|float */
		private $number;

		/** @var string */
		private $unit;


		/**
		 * @param int|float $number
		 */
		public function __construct($number, string $unit = '')
		{
			$this->number = $number;
			$this->unit = $unit;
		}


		public function render(): string
		{
			return $this->number . $this->unit;
		}


		public static function px2em(int $pixels, int $precision = 4): self
		{
			return new self(round($pixels / 16, $precision), 'em');
		}


		public static function px2rem(int $pixels, int $precision = 4): self
		{
			return new self(round($pixels / 16, $precision), 'rem');
		}
	}
