<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class CssRule
	{
		/** @var string */
		private $selector;

		/** @var CssProperty[] */
		private $properties = [];


		public function __construct(string $selector)
		{
			$this->selector = $selector;
		}


		public function addProperty(string $name, CssValue $value): CssProperty
		{
			return $this->properties[] = new CssProperty($name, $value);
		}


		public function render(): string
		{
			$s = '';

			foreach ($this->properties as $property) {
				$propertyString = $property->render();
				$s .= $propertyString;
			}

			if ($s !== '') {
				return $this->selector . " {\n" . $s . "}\n";
			}

			return $s;
		}
	}
