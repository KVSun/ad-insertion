<?php
require_once './functions.php';
\shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
\shgysk8zer0\DOM\HTMLElement::$import_path = realpath(getenv('COMPONENTS_DIR'));
$headers = \shgysk8zer0\Core\Headers::getInstance();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom = \shgysk8zer0\DOM\HTML::getInstance();
	$dom->body->class = 'flex column';
	call_user_func($dom->head, 'head');
	call_user_func($dom->body, 'header', 'main', 'forms/ad-insertion', 'footer');
	exit($dom);
} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {
	$resp = \shgysk8zer0\Core\JSON_Response::load();
	if (array_key_exists('load', $_REQUEST)) {
		switch($_REQUEST['load']) {
			case 'readme':

				$dom = \shgysk8zer0\DOM\HTML::getInstance();
				call_user_func($dom->body, 'readme');
				$readme = $dom->getElementsByTagName('dialog')->item(0);
				$resp->append('body', $readme);
				$resp->showModal("#{$readme->id}");
				break;
		}
	}
	$resp->send();
	exit();
} else {
	http_response_code(404);
}
