<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestAppTests\Utils;

use Nette\SmartObject;
use Wavevision\NetteTests\TestCases\DIContainerTestCase;
use Wavevision\NetteTests\Utils\FileHelpers;
use Wavevision\NetteTests\Utils\InjectFileHelpers;
use Wavevision\Utils\Path;
use function touch;

class FileHelpersTest extends DIContainerTestCase
{

	use SmartObject;
	use InjectFileHelpers;

	public function testFiles(): void
	{
		$fileUploads = [
			$this->fileHelpers->pngFileUpload(),
			$this->fileHelpers->jpgFileUpload(),
			$this->fileHelpers->pdfFileUpload(),
		];
		foreach ($fileUploads as $fileUpload) {
			$this->assertFileExists($fileUpload->getTemporaryFile());
		}
		$this->assertFileExists($this->fileHelpers->html());
	}

	public function testCorruptedFileUpload(): void
	{
		$this->assertFalse($this->fileHelpers->corruptedFileUpload()->isOk());
	}

	public function testSourceFile(): void
	{
		$this->assertIsString($this->fileHelpers->sourceFile(__DIR__, 'test.txt'));
	}

	public function testOutputFile(): void
	{
		$this->assertIsString($this->fileHelpers->outputFile(__DIR__, 'test.txt'));
	}

	public function testCleanDefaultOutput(): void
	{
		$this->fileHelpers->pngFileUpload();
		$this->assertDirectoryExists($this->fileHelpers->getDefaultOutputDirectory());
		$this->fileHelpers->cleanDefaultOutput();
		$this->assertDirectoryDoesNotExist($this->fileHelpers->getDefaultOutputDirectory());
	}

	public function testCleanCustom(): void
	{
		$file = $this->fileHelpers->outputFile(__DIR__, 'test.txt');
		touch($file);
		$dir = Path::join(__DIR__, FileHelpers::TEST_OUTPUT_FILES);
		$this->assertDirectoryExists($dir);
		$this->fileHelpers->cleanCustomOutput(__DIR__);
		$this->assertDirectoryDoesNotExist($dir);
	}

}
