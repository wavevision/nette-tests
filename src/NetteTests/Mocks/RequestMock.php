<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Mocks;

use Nette\Http\Request;
use Nette\Http\UrlScript;
use Nette\Utils\Json;

class RequestMock extends Request
{

	public const URL = 'http://localhost';

	/**
	 * @var string
	 */
	private $rawBodyMock;

	/**
	 * @var array<mixed>
	 */
	private $filesMock;

	/**
	 * @var string
	 */
	private $methodMock;

	/**
	 * @var array<mixed>
	 */
	private $headersMock;

	/**
	 * @var bool
	 */
	private $isSameSiteMock;

	public function __construct()
	{
		$urlScript = new UrlScript(self::URL);
		$this->isSameSiteMock = true;
		parent::__construct($urlScript);
	}

	public function getRawBody(): string
	{
		return $this->rawBodyMock;
	}

	/**
	 * @return array<mixed>
	 */
	public function getFiles(): array
	{
		return $this->filesMock;
	}

	public function getMethod(): string
	{
		return $this->methodMock;
	}

	/**
	 * @param mixed $name
	 * @return mixed
	 */
	public function getFile($name)
	{
		return isset($this->getFiles()[$name]) ? $this->getFiles()[$name] : null;
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 */
	public function getHeader($header): ?string
	{
		if (isset($this->headersMock[$header])) {
			return $this->headersMock[$header];
		}
		return parent::getHeader($header);
	}

	/**
	 * @param array<mixed> $body
	 */
	public function setRawBodyMock(array $body): void
	{
		$this->rawBodyMock = Json::encode($body);
	}

	/**
	 * @param array<mixed> $files
	 */
	public function setFilesMock(array $files): RequestMock
	{
		$this->filesMock = $files;
		return $this;
	}

	public function setMethodMock(string $methodMock): RequestMock
	{
		$this->methodMock = $methodMock;
		return $this;
	}

	/**
	 * @phpcsSuppress SlevomatCodingStandard.TypeHints.TypeHintDeclaration.MissingParameterTypeHint
	 */
	public function addHeaderMock($header, $value): RequestMock
	{
		if (!isset($this->headersMock[$header])) {
			$this->headersMock[$header] = $value;
		}
		return $this;
	}

	public function setIsSameSiteMock(bool $isSameSiteMock): self
	{
		$this->isSameSiteMock = $isSameSiteMock;
		return $this;
	}

	public function isSameSite(): bool
	{
		return $this->isSameSiteMock;
	}

}
