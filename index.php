<?php
namespace Index;

use \shgysk8zer0\Core as Core;
use \shgysk8zer0\Core_API as API;
use \shgysk8zer0\DOM as DOM;

function build_head(\DOMElement &$head)
{
	$head('head');
}

function cli_config($config = './config/env.json')
{
	$config = json_decode(file_get_contents($config), true);
	foreach ($config as $key => $value) {
		putenv("$key=$value");
	}
}

function build_body(\DOMElement &$body)
{
	$body->parentNode->class = 'no-js';
	$body->class = 'flex column';
	$body('header', 'main', 'footer');
}

function init()
{
	if (in_array(PHP_SAPI, ['cli', 'cli-server'])) {
		cli_config();
	}
	require_once realpath(getenv('AUTOLOAD_SCRIPT'));
	Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
	DOM\HTMLElement::$import_path = realpath(getenv('COMPONENTS_DIR'));

	$headers = Core\Headers::getInstance();
	$dom     = DOM\HTML::getInstance();

	if ($headers->accept === 'application/json' and !empty($_REQUEST)) {
		require_once './components/handlers/request.php';
		$resp = \Components\Handlers\Request\handle($_REQUEST);
		Core\Console::getInstance()->sendLogHeader();
		return $resp;
	} elseif ($headers->accept = '*/*' or in_array('text/html', explode(',', $headers->accept))) {
		build_head($dom->head);
		build_body($dom->body);
		Core\Console::getInstance()->sendLogHeader();
		return $dom;
	} else {
		http_response_code(API\Abstracts\HTTPStatusCodes::BAD_REQUEST);
	}
}
exit(init());
