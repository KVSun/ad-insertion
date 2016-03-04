<?php
namespace Components\Handlers\Request;
use \shgysk8zer0\Core as Core;

function load_handler($handler)
{
	$ext = \pathinfo($handler, PATHINFO_EXTENSION);
	if (empty($ext)) {
		$handler .= '.php';
	}
	return require_once __DIR__ . DIRECTORY_SEPARATOR . $handler;
}

function handle(array $req)
{
	if (array_key_exists('load', $_REQUEST)) {
		return load_handler('load');
	} else {
		Core\JSON_Response::getInstance()->log($_REQUEST);
	}
}
