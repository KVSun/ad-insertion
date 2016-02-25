<?php
\shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
\shgysk8zer0\DOM\HTMLElement::$import_path = realpath(getenv('COMPONENTS_DIR'));
$url = \shgysk8zer0\Core\URL::getInstance();
$headers = \shgysk8zer0\Core\Headers::getInstance();
$dom = \shgysk8zer0\DOM\HTML::getInstance();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom->body->class = 'flex column';
	call_user_func($dom->head, 'head');
	call_user_func($dom->body, 'header', 'main', 'footer');
	\shgysk8zer0\Core\Console::getInstance()->sendLogHeader();
	exit($dom);
} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {
	require './components/handlers/request.php';
	exit;
} else {
	http_response_code(\shgysk8zer0\Core_API\Abstracts\HTTPStatusCodes::BAD_REQUEST);
}
