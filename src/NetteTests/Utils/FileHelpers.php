<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Utils;

use Nette\Http\FileUpload;
use Nette\SmartObject;
use Nette\Utils\FileSystem;
use Nette\Utils\Random;
use SplFileInfo;
use Wavevision\DIServiceAnnotation\DIService;
use Wavevision\Utils\FileInfo;
use Wavevision\Utils\Finder;
use Wavevision\Utils\Path;
use function basename;
use const UPLOAD_ERR_CANT_WRITE;
use const UPLOAD_ERR_OK;

/**
 * @DIService(generateInject=true, params={"%tempDir%"})
 */
class FileHelpers
{

	use SmartObject;

	public const PNG = 'image.png';

	public const JPG = 'image.jpg';

	public const HTML = 'document.html';

	public const PDF = 'document.pdf';

	public const TEST_SOURCE_FILES = 'test-source-files';

	public const TEST_OUTPUT_FILES = 'test-output-files';

	private string $defaultOutputDirectory;

	public function __construct(string $tempDir)
	{
		$this->setDefaultOutputDirectory(Path::join($tempDir, self::TEST_OUTPUT_FILES));
	}

	/**
	 * @return static
	 */
	public function setDefaultOutputDirectory(string $defaultOutputDirectory)
	{
		$this->defaultOutputDirectory = $defaultOutputDirectory;
		return $this;
	}

	public function getDefaultOutputDirectory(): string
	{
		return $this->defaultOutputDirectory;
	}

	public function sourceFile(string $directory, string $name): string
	{
		return Path::join($directory, self::TEST_SOURCE_FILES, $name);
	}

	public function outputFile(string $directory, string $name): string
	{
		return Path::join($this->outputDirectory(Path::join($directory, self::TEST_OUTPUT_FILES)), $name);
	}

	public function outputDirectory(string $directory): string
	{
		return $this->createDirectory($directory);
	}

	public function png(): string
	{
		return $this->file(self::PNG);
	}

	public function jpg(): string
	{
		return $this->file(self::JPG);
	}

	public function html(): string
	{
		return $this->file(self::HTML);
	}

	public function pdf(): string
	{
		return $this->file(self::PDF);
	}

	public function pngFileUpload(): FileUpload
	{
		return $this->getFileUploadFromFile($this->png());
	}

	public function pdfFileUpload(): FileUpload
	{
		return $this->getFileUploadFromFile($this->pdf());
	}

	public function jpgFileUpload(): FileUpload
	{
		return $this->getFileUploadFromFile($this->jpg());
	}

	public function file(string $fileName): string
	{
		$original = $this->getSourceFile($fileName);
		$testFile = $this->outputDirectory($this->defaultOutputDirectory) . '/' . Random::generate() . basename(
			$original
		);
		FileSystem::copy($original, $testFile);
		return $testFile;
	}

	public function getFileUploadFromFile(string $filepath): FileUpload
	{
		$fileInfo = new FileInfo($filepath);
		return new FileUpload(
			[
				'name' => $fileInfo->getBaseName(),
				'type' => $fileInfo->getContentType(),
				'size' => $fileInfo->getSize(),
				'tmp_name' => $filepath,
				'error' => UPLOAD_ERR_OK,
			]
		);
	}

	public function corruptedFileUpload(): FileUpload
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

	public function cleanDefaultOutput(): void
	{
		FileSystem::delete($this->getDefaultOutputDirectory());
	}

	public function cleanCustomOutput(string $directory): void
	{
		$directories = [];
		/** @var SplFileInfo $directory */
		foreach (Finder::findDirectories(self::TEST_OUTPUT_FILES)->from($directory) as $directory) {
			$directories[] = $directory->getPathname();
		}
		foreach ($directories as $directory) {
			FileSystem::delete($directory);
		}
	}

	private function createDirectory(string $name): string
	{
		FileSystem::createDir($name);
		return $name;
	}

	private function getSourceFile(string $name): string
	{
		return Path::join(__DIR__, self::TEST_SOURCE_FILES, $name);
	}

}
