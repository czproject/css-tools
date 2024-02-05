<?php

declare(strict_types=1);

use CzProject\CssTools\CssCompiler;
use Tester\Assert;

require __DIR__ . '/../bootstrap.php';


class FileContent
{
	/** @var string */
	private $content;


	private function __construct(string $content)
	{
		$this->content = $content;
	}


	public function toString(): string
	{
		return $this->content;
	}


	public function write(string $path): void
	{
		@mkdir(dirname($path), 0777, TRUE);
		file_put_contents($path, $this->content);
	}


	/**
	 * @param  string[] $lines
	 */
	public static function create(array $lines): self
	{
		return new self(implode("\n", $lines) . "\n");
	}
}


Tests::testWithTempDir('Basic', function ($tempDir) {
	$compiler = new CssCompiler;

	FileContent::create([
		"@import 'http://example.com/';",
		"@import 'style2.css';",
		"@import 'dir/style3.css';",
		"@import 'style5.css' all;",
		"@import 'style6.css' screen and (min-width: 50em);",
		"@import 'style7.css' screen and (min-width: 50em);",
		"@import 'style10.css' screen and (min-width: 300px);"
	])->write($tempDir . '/styles.css');

	FileContent::create([
		"/* STYLE 2 */",
	])->write($tempDir . '/style2.css');

	FileContent::create([
		"/* STYLE 3 */",
		"@import '../style4.css';",
	])->write($tempDir . '/dir/style3.css');

	FileContent::create([
		"/* STYLE 4 */",
	])->write($tempDir . '/style4.css');

	FileContent::create([
		"/* STYLE 5 */",
	])->write($tempDir . '/style5.css');

	FileContent::create([
		"/* STYLE 6 */",
	])->write($tempDir . '/style6.css');

	FileContent::create([
		"/* STYLE 7 */",
		"@import 'style8.css'",
	])->write($tempDir . '/style7.css');

	FileContent::create([
		"/* STYLE 8 */",
		"@import 'style9.css' screen",
	])->write($tempDir . '/style8.css');

	FileContent::create([
		"/* STYLE 9 */",
	])->write($tempDir . '/style9.css');

	FileContent::create([
		"/* STYLE 10 */",
		"@import 'style11.css' screen and (min-width: 300px);",
	])->write($tempDir . '/style10.css');

	FileContent::create([
		"/* STYLE 11 */",
	])->write($tempDir . '/style11.css');

	$compiler->compileFile($tempDir . '/styles.css');

	Assert::same(
		FileContent::create([
			"@import 'http://example.com/';",
			"/* STYLE 2 */",
			"/* STYLE 3 */",
			"/* STYLE 4 */",
			"/* STYLE 5 */",
			"@media screen and (min-width: 50em) {",
			"/* STYLE 6 */",
			"}",
			"@media screen and (min-width: 50em) {",
			"/* STYLE 7 */",
			"@import 'style8.css'",
			"}",
			"@media screen and (min-width: 300px) {",
			"/* STYLE 10 */",
			"/* STYLE 11 */",
			"}",
		])->toString(),
		file_get_contents($tempDir . '/styles.css')
	);
});
