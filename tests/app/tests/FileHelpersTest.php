<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests;

use Nette\SmartObject;
use PHPUnit\Framework\TestCase;
use Wavevision\NetteTests\Utils\FileHelpers;

class FileHelpersTest extends TestCase
{

	use SmartObject;

	public function testFiles(): void
	{
		$fileUploads = [
			FileHelpers::pngFileUpload(),
			FileHelpers::jpgFileUpload(),
			FileHelpers::pdfFileUpload(),
		];
		foreach ($fileUploads as $fileUpload) {
			$this->assertFileExists($fileUpload->getTemporaryFile());
		}
		$this->assertFileExists(FileHelpers::html());
	}

	public function testCorruptedFileUpload(): void
	{
		$this->assertFalse(FileHelpers::corruptedFileUpload()->isOk());
	}

	public function testSourceFile(): void
	{
		$this->assertIsString(FileHelpers::sourceFile(__DIR__, 'test.txt'));
	}

	public function testOutputFile(): void
	{
		$this->assertIsString(FileHelpers::outputFile(__DIR__, 'test.txt'));
	}

}
