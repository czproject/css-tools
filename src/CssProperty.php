<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class CssProperty
	{
		/** @var string */
		private $name;

		/** @var CssValue */
		private $value;


		public function __construct(string $name, CssValue $value)
		{
			$this->name = $name;
			$this->value = $value;
		}


		public function render(): string
		{
			return $this->name . ': ' . $this->value->render() . ";\n";
		}
	}
