<?php
namespace Index;
use \shgysk8zer0\Core as Core;
use \shgysk8zer0\Core_API as API;
use \shgysk8zer0\DOM as DOM;

Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
DOM\HTMLElement::$import_path = realpath(getenv('COMPONENTS_DIR'));

function build_head(\DOMElement &$head)
{
	$head('head');
}

function build_body(\DOMElement &$body)
{
	$body->parentNode->class = 'no-js';
	$body->class = 'flex column';
	$body('header', 'main', 'footer');
}

function init()
{
	$headers = Core\Headers::getInstance();
	$dom     = DOM\HTML::getInstance();

	if (in_array('text/html', explode(',', $headers->accept))) {
		build_head($dom->head);
		build_body($dom->body);
		return $dom;
	} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {
		require_once './components/handlers/request.php';
		return \Components\Handlers\Request\handle($_REQUEST);
	} else {
		http_response_code(API\Abstracts\HTTPStatusCodes::BAD_REQUEST);
	}
}
Core\Console::getInstance()->sendLogHeader();
exit(init());
