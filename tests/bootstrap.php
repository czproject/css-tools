<?php

declare(strict_types=1);

require __DIR__ . '/../vendor/autoload.php';

Tester\Environment::setup();


function test(string $description, callable $closure): void
{
	$closure();
}


class Tests
{
	private function __construct()
	{
	}


	public static function testWithTempDir(string $description, callable $action): void
	{
		$tempDir = self::prepareTempDir();
		$action($tempDir);
		Tester\Helpers::purge($tempDir);
		rmdir($tempDir);
	}


	private static function prepareTempDir(): string
	{
		@mkdir(__DIR__ . '/tmp');  // @ - adresář již může existovat
		return __DIR__ . '/tmp/' . getmypid();
	}
}
