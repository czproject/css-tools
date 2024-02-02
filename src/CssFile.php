<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class CssFile
	{
		/** @var CssRule[] */
		private $rules;


		/**
		 * @param array<string, CssValue|NULL> $properties
		 */
		public function addRule(string $selector, array $properties = []): CssRule
		{
			$rule = $this->rules[] = new CssRule($selector);

			foreach ($properties as $property => $propertyValue) {
				if ($propertyValue === NULL) {
					continue;
				}

				$rule->addProperty($property, $propertyValue);
			}

			return $rule;
		}


		public function render(): string
		{
			$s = '';

			foreach ($this->rules as $rule) {
				$ruleString = $rule->render();
				$s .= $ruleString;
			}

			return $s;
		}
	}
