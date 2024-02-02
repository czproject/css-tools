<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class Url implements CssValue
	{
		/** @var string */
		private $url;


		public function __construct(string $url)
		{
			$this->url = $url;
		}


		public function render(): string
		{
			return 'url(' . addcslashes($this->url, "\x00..\x2C./:;<=>?@[\\]^`{|}~") . ')';
		}
	}
