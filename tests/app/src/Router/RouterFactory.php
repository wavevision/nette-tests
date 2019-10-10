<?php declare(strict_types = 1);

namespace Wavevision\NetteTests\TestApp\Router;

use Nette\Application\Routers\RouteList;
use Nette\StaticClass;

final class RouterFactory
{

	use StaticClass;

	public static function createRouter(): RouteList
	{
		$router = new RouteList();
		$router->addRoute('<presenter>/<action>[/<id>]', 'Homepage:default');
		return $router;
	}

}
