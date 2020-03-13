<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Application\UI\Presenter;
use Nette\Http\IRequest;
use Nette\SmartObject;

class PresenterRequest
{

	use SmartObject;

	public const DEFAULT_ACTION = 'default';

	public const SIGNAL_QUERY_PARAMETER = 'do';

	private string $className;

	private string $action;

	/**
	 * @var array<mixed>
	 */
	private array $query;

	private string $method;

	/**
	 * @var array<mixed>
	 */
	private array $post;

	/**
	 * @var array<mixed>
	 */
	private array $files;

	private Presenter $presenter;

	private string $presenterName;

	/**
	 * @var callable[]
	 */
	private array $beforeRunCallbacks = [];

	private ?bool $ajax = null;

	/**
	 * @param array<mixed> $query
	 * @param array<mixed> $post
	 * @param array<mixed> $files
	 */
	public function __construct(
		string $className,
		string $action = self::DEFAULT_ACTION,
		array $query = [],
		string $method = IRequest::GET,
		array $post = [],
		array $files = []
	) {
		$this->className = $className;
		$this->action = $action;
		$this->query = $query;
		$this->method = $method;
		$this->post = $post;
		$this->files = $files;
		$this->query['action'] = $action;
	}

	public function getClassName(): string
	{
		return $this->className;
	}

	public function setClassName(string $className): PresenterRequest
	{
		$this->className = $className;
		return $this;
	}

	public function getAction(): string
	{
		return $this->action;
	}

	public function setAction(string $action): PresenterRequest
	{
		$this->action = $action;
		return $this;
	}

	/**
	 * @return array<mixed>
	 */
	public function getQuery(): array
	{
		return $this->query;
	}

	/**
	 * @param array<mixed> $query
	 */
	public function setQuery(array $query): PresenterRequest
	{
		$this->query = $query;
		return $this;
	}

	public function getMethod(): string
	{
		return $this->method;
	}

	public function setMethod(string $method): PresenterRequest
	{
		$this->method = $method;
		return $this;
	}

	/**
	 * @return array<mixed>
	 */
	public function getPost(): array
	{
		return $this->post;
	}

	/**
	 * @param array<mixed> $post
	 */
	public function setPost(array $post): PresenterRequest
	{
		$this->post = $post;
		return $this;
	}

	/**
	 * @return array<mixed>
	 */
	public function getFiles(): array
	{
		return $this->files;
	}

	/**
	 * @param array<mixed> $files
	 */
	public function setFiles(array $files): PresenterRequest
	{
		$this->files = $files;
		return $this;
	}

	/**
	 * @param mixed $name
	 * @param mixed $value
	 */
	public function addQuery($name, $value): self
	{
		$this->query[$name] = $value;
		return $this;
	}

	/**
	 * @param mixed $name
	 * @param mixed $value
	 */
	public function addPost($name, $value): self
	{
		$this->post[$name] = $value;
		return $this;
	}

	public function getPresenter(): Presenter
	{
		return $this->presenter;
	}

	public function setPresenter(Presenter $presenter): self
	{
		$this->presenter = $presenter;
		return $this;
	}

	public function getPresenterName(): string
	{
		return $this->presenterName;
	}

	public function setPresenterName(string $presenterName): self
	{
		$this->presenterName = $presenterName;
		return $this;
	}

	public function setSignal(string $signalName): self
	{
		$this->query[self::SIGNAL_QUERY_PARAMETER] = $signalName;
		return $this;
	}

	public function addBeforeRunCallback(callable $beforeRunCallback): self
	{
		$this->beforeRunCallbacks[] = $beforeRunCallback;
		return $this;
	}

	/**
	 * @return array<callable>
	 */
	public function getBeforeRunCallbacks(): array
	{
		return $this->beforeRunCallbacks;
	}

	public function getAjax(): ?bool
	{
		return $this->ajax;
	}

	public function setAjax(bool $ajax): self
	{
		$this->ajax = $ajax;
		return $this;
	}

}
