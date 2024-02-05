<?php

	declare(strict_types=1);

	namespace CzProject\CssTools;


	class CssCompiler
	{
		public function compileFile(string $file): void
		{
			file_put_contents($file, $this->processFile($file));
		}


		public function processFile(string $file): string
		{
			$content = file_get_contents($file);

			if (!is_string($content)) {
				throw new SorryOperationFailed("File '$file' not found or it isn't readable.");
			}

			return $this->expandCssImports($content, dirname($file));
		}


		public function processContent(string $content, string $currentDirectory): string
		{
			return $this->expandCssImports($content, $currentDirectory);
		}


		/**
		 * @see https://github.com/dg/ftp-deployment/blob/bf1cffb597896dd0d05cded01a9c3a16596c506d/src/Deployment/Preprocessor.php#L104
		 */
		private function expandCssImports(string $content, string $currentDirectory, string $currentMediaQuery = NULL): string
		{
			return (string) preg_replace_callback('#@import\s+(?:url)?[(\'"]+(.+)[)\'"]+(\s+.+)?;#U', function ($m) use ($currentDirectory, $currentMediaQuery) {
				$file = $currentDirectory . '/' . $m[1];

				if (!is_file($file)) {
					return $m[0];
				}

				$s = file_get_contents($file);

				if ($s === FALSE) {
					throw new SorryOperationFailed("Reading of file $file failed.");
				}

				$newDir = dirname($file);
				$mediaQuery = isset($m[2]) ? $this->normalizeMediaQuery($m[2]) : NULL;

				if ($currentMediaQuery !== NULL && $mediaQuery !== $currentMediaQuery) {
					return $m[0];
				}

				$s = $this->expandCssImports($s, $newDir, $mediaQuery);

				if ($mediaQuery !== NULL && $mediaQuery !== $currentMediaQuery) {
					$s = '@media ' . $mediaQuery . " {\n"
						. $s
						. "}\n";
				}

				if ($newDir !== $currentDirectory) {
					$tmp = $currentDirectory . '/';

					if (substr($newDir, 0, strlen($tmp)) === $tmp) {
						$s = preg_replace('#\burl\(["\']?(?=[.\w])(?!\w+:)#', '$0' . substr($newDir, strlen($tmp)) . '/', $s);

						if ($s === NULL) {
							throw new SorryOperationFailed("Replacing of content failed.");
						}

					} elseif (strpos($s, 'url(') !== FALSE) {
						return $m[0];
					}
				}

				return rtrim($s, "\n");

			}, $content);
		}


		private function normalizeMediaQuery(string $mediaQuery): ?string
		{
			$mediaQuery = trim($mediaQuery);

			if ($mediaQuery === '' || $mediaQuery === 'all') {
				return NULL;
			}

			return $mediaQuery;
		}
	}
