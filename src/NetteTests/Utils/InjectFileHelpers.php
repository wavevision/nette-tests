<?php declare (strict_types = 1);

namespace Wavevision\NetteTests\Utils;

trait InjectFileHelpers
{

	protected FileHelpers $fileHelpers;

	public function injectFileHelpers(FileHelpers $fileHelpers): void
	{
		$this->fileHelpers = $fileHelpers;
	}

}
