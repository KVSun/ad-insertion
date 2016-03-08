<?php
namespace Components\Handlers\Request;
use \shgysk8zer0\Core as Core;

function load_handler($handler)
{
	if (! pathinfo($handler, PATHINFO_EXTENSION)) {
		$handler .= '.php';
	}
	require_once __DIR__ . DIRECTORY_SEPARATOR . $handler;
}

function handle(array $req)
{
	if (array_key_exists('load', $_REQUEST)) {
		load_handler('load');
		return \Components\Handlers\Load\load_request($_REQUEST['load']);
	} else {
		Core\Console::getInstance()->log($_REQUEST);
	}
}
