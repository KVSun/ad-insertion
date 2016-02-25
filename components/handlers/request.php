<?php
namespace KVSun\Handlers
{
	function load_handler($handler)
	{
		$ext = \pathinfo($handler, PATHINFO_EXTENSION);
		if (empty($ext)) {
			$handler .= '.php';
		}
		require_once __DIR__ . DIRECTORY_SEPARATOR . $handler;
	}
	if (array_key_exists('load', $_REQUEST)) {
		load_handler('load');
	} else {
		\shgysk8zer0\Core\JSON_Response::getInstance()->log($_REQUEST);
	}
	exit(\shgysk8zer0\Core\JSON_Response::getInstance());
}
