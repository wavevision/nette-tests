<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\Runners;

use Nette\Http\IRequest;
use Nette\SmartObject;

class SubmitFormRequest extends PresenterRequest
{

	use SmartObject;

	private string $formName;

	/**
	 * @param array<mixed> $query
	 * @param array<mixed> $post
	 * @param array<mixed> $files
	 */
	public function __construct(
		string $formName,
		string $presenterClassName,
		string $action = self::DEFAULT_ACTION,
		array $query = [],
		array $post = [],
		array $files = []
	) {
		parent::__construct($presenterClassName, $action, $query, IRequest::POST, $post, $files);
		$this->formName = $formName;
	}

	public function getFormName(): string
	{
		return $this->formName;
	}

	public function setFormName(string $formName): self
	{
		$this->formName = $formName;
		return $this;
	}

}
