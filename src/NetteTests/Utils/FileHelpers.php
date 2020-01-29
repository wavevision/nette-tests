<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Utils;

use Nette\Http\FileUpload;
use Nette\StaticClass;
use Nette\Utils\FileSystem;
use Nette\Utils\Random;
use Wavevision\NetteTests\InvalidState;
use Wavevision\Utils\Path;

class FileHelpers
{

	public const PNG = 'image.png';

	public const JPG = 'image.jpg';

	public const HTML = 'document.html';

	public const PDF = 'document.pdf';

	public const TEST_OUTPUT_FILES = 'test-output-files';

	use StaticClass;

	/**
	 * @var string
	 */
	public static $outputDirectory = __DIR__;

	public static function sourceFile(string $directory, string $name): string
	{
		return Path::join($directory, 'test-source-files', $name);
	}

	public static function outputFile(string $directory, string $name): string
	{
		return Path::join(self::outputDirectory($directory), $name);
	}

	public static function outputDirectory(string $directory): string
	{
		return self::createDirectory(Path::join($directory, self::TEST_OUTPUT_FILES));
	}

	public static function png(): string
	{
		return self::file(self::PNG);
	}

	public static function jpg(): string
	{
		return self::file(self::JPG);
	}

	public static function html(): string
	{
		return self::file(self::HTML);
	}

	public static function pdf(): string
	{
		return self::file(self::PDF);
	}

	public static function pngFileUpload(): FileUpload
	{
		return self::getFileUploadFromFile(self::png());
	}

	public static function pdfFileUpload(): FileUpload
	{
		return self::getFileUploadFromFile(self::pdf());
	}

	public static function jpgFileUpload(): FileUpload
	{
		return self::getFileUploadFromFile(self::jpg());
	}

	public static function file(string $fileName): string
	{
		$original = self::getSourceFile($fileName);
		$testFile = self::outputDirectory(self::$outputDirectory) . '/' . Random::generate() . basename($original);
		FileSystem::copy($original, $testFile);
		return $testFile;
	}

	public static function getFileUploadFromFile(string $filepath): FileUpload
	{
		$finfo = finfo_open(FILEINFO_MIME_TYPE);
		if ($finfo === false) {
			throw new InvalidState('Failed to get fileinfo.');
		}
		return new FileUpload(
			[
				'name' => basename($filepath),
				'type' => finfo_file($finfo, $filepath),
				'size' => filesize($filepath),
				'tmp_name' => $filepath,
				'error' => UPLOAD_ERR_OK,
			]
		);
	}

	public static function corruptedFileUpload(): FileUpload
	{
		return new FileUpload(
			[
				'name' => '',
				'type' => '',
				'size' => 0,
				'tmp_name' => '',
				'error' => UPLOAD_ERR_CANT_WRITE,
			]
		);
	}

	private static function createDirectory(string $name): string
	{
		FileSystem::createDir($name);
		return $name;
	}

	private static function getSourceFile(string $name): string
	{
		return sprintf('%s/files/%s', __DIR__, $name);
	}

}
