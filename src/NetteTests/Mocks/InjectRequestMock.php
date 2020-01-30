<?php declare (strict_types = 1);

namespace Wavevision\NetteTests\Mocks;

trait InjectRequestMock
{

	protected RequestMock $requestMock;

	public function injectRequestMock(RequestMock $requestMock): void
	{
		$this->requestMock = $requestMock;
	}

}
