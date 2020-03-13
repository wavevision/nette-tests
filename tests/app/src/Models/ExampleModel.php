<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Models;

use Nette\Http\Request;
use Nette\SmartObject;

class ExampleModel
{

	use SmartObject;

	private Request $request;

	public function __construct(Request $request)
	{
		$this->request = $request;
	}

	public function getDomain(): string
	{
		return $this->request->getUrl()->getDomain();
	}

	public function getRemoteAddress(): ?string
	{
		return $this->request->getRemoteAddress();
	}

}
