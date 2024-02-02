<?php

	namespace Cz\CssMinifier;


	class CssMinifier
	{
		const S_NORMAL = 0;
		const S_STRING = 1;


		/**
		 * @link	https://github.com/nette/build-tools/blob/master/tasks/minifyJs.php#L51-L56
		 * @author	David Grudl, 2011
		 * @param	string
		 * @return	string
		 */
		public function minify($s)
		{
			$s = preg_replace('#/\*.*?\*/#s', '', $s); // remove comments
			$s = preg_replace('#\s+#', ' ', $s); // compress space
			$s = preg_replace('# ([^(0-9a-z.\#*-])#i', '$1', $s);
			$s = preg_replace('#([^0-9a-z%)]) #i', '$1', $s);

			while (strpos($s, ';}') !== FALSE) {
				$s = str_replace(';}', '}', $s); // remove leading semicolon
			}

			$s = trim($s);

			// replace SPACE => NEW LINE
			$state = self::S_NORMAL;
			$stringChar = '';
			$lastChar = NULL;
			$len = strlen($s);
			$buffer = '';

			for ($i = 0; $i < $len; $i++) {
				$currentChar = $s[$i];

				if ($state === self::S_NORMAL) {
					if ($s[$i] === '\'' || $s[$i] === '"') {
						$state = self::S_STRING;
						$stringChar = $s[$i];

					} elseif ($s[$i] === ' ') {
						//$s[$i] = "\n";
						$buffer .= "\n";
						continue;

					} elseif ($s[$i] === ';') {
						if ($lastChar === ';') {
							continue;
						}
					}
				} elseif($state === self::S_STRING) {
					if ($lastChar !== '\\' && $s[$i] === $stringChar) {
						$state = self::S_NORMAL;
						$stringChar = '';
					}
				}

				$buffer .= $lastChar = $currentChar;
			}

			return $buffer;
		}
	}

