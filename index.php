<?php
namespace Index;
\shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
\shgysk8zer0\DOM\HTMLElement::$import_path = realpath(getenv('COMPONENTS_DIR'));

function build_head(\DOMElement $head)
{
	$head('head');
}

function build_body(\DOMElement $body)
{
	$body->parentNode->class = 'no-js';
	$body->class = 'flex column';
	$body('header', 'main', 'footer');
}

function init()
{
	$url = \shgysk8zer0\Core\URL::getInstance();
	$headers = \shgysk8zer0\Core\Headers::getInstance();
	$dom = \shgysk8zer0\DOM\HTML::getInstance();
	if (in_array('text/html', explode(',', $headers->accept))) {
		build_head($dom->head);
		build_body($dom->body);
		return $dom;
	} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {
		return require './components/handlers/request.php';
	} else {
		http_response_code(\shgysk8zer0\Core_API\Abstracts\HTTPStatusCodes::BAD_REQUEST);
	}
}
\shgysk8zer0\Core\Console::getInstance()->sendLogHeader();
exit(init());
