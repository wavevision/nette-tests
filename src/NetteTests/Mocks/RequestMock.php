<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Mocks;

use Nette\Http\Request;
use Nette\Http\UrlScript;
use Wavevision\DIServiceAnnotation\DIService;
use Wavevision\NetteTests\InvalidState;
use function sprintf;

/**
 * @DIService(generateInject=true, name="http.request")
 */
class RequestMock extends Request
{

	public const URL = 'http://localhost';

	private ?bool $ajaxMock;

	private ?string $rawBodyMock;

	/**
	 * @var array<mixed>
	 */
	private array $filesMock;

	private ?string $methodMock;

	/**
	 * @var array<mixed>
	 */
	private array $headersMock;

	private bool $isSameSiteMock;

	/**
	 * @var array<mixed>
	 */
	private array $postMock;

	/**
	 * @var array<mixed>
	 */
	private ?array $queryMock;

	private ?string $remoteAddressMock;

	public function __construct()
	{
		$urlScript = new UrlScript(self::URL);
		$this->ajaxMock = null;
		$this->rawBodyMock = null;
		$this->filesMock = [];
		$this->methodMock = null;
		$this->headersMock = [];
		$this->isSameSiteMock = true;
		$this->postMock = [];
		$this->queryMock = null;
		$this->remoteAddressMock = null;
		parent::__construct($urlScript);
	}

	public function isAjax(): bool
	{
		if ($this->ajaxMock === null) {
			return parent::isAjax();
		}
		return $this->ajaxMock;
	}

	public function setAjaxMock(?bool $ajaxMock): self
	{
		$this->ajaxMock = $ajaxMock;
		return $this;
	}

	public function getRawBody(): string
	{
		if ($this->rawBodyMock === null) {
			throw new InvalidState(sprintf('Raw body is not set. Use method %s::setRawBodyMock', self::class));
		}
		return $this->rawBodyMock;
	}

	/**
	 * @return mixed
	 */
	public function getPost(?string $key = null)
	{
		if ($key === null) {
			return $this->postMock;
		}
		parent::getPost();
		return $this->postMock[$key] ?? null;
	}

	/**
	 * @return mixed
	 */
	public function getQuery(?string $key = null)
	{
		if ($this->queryMock === null) {
			if ($key === null) {
				return parent::getQuery();
			} else {
				return parent::getQuery($key);
			}
		}
		if ($key === null) {
			return $this->queryMock;
		}
		return $this->queryMock[$key] ?? null;
	}

	/**
	 * @param array<mixed> $postMock
	 */
	public function setPostMock(array $postMock): self
	{
		$this->postMock = $postMock;
		return $this;
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
		return $this->methodMock ?? $this->method;
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
	 * @param mixed $header
	 */
	public function getHeader($header): ?string
	{
		if (isset($this->headersMock[$header])) {
			return $this->headersMock[$header];
		}
		return parent::getHeader($header);
	}

	public function setRawBodyMock(string $body): self
	{
		$this->rawBodyMock = $body;
		return $this;
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
	 * @param mixed $header
	 * @param mixed $value
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

	public function getRemoteAddress(): ?string
	{
		return $this->remoteAddressMock ?? parent::getRemoteAddress();
	}

	/**
	 * @return static
	 */
	public function setRemoteAddressMock(string $remoteAddressMock)
	{
		$this->remoteAddressMock = $remoteAddressMock;
		return $this;
	}

	/**
	 * @param array<mixed> $queryMock
	 * @return static
	 */
	public function setQueryMock(array $queryMock)
	{
		$this->queryMock = $queryMock;
		return $this;
	}

}
