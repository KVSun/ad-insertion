<?php
\shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
\shgysk8zer0\DOM\HTMLElement::$import_path = realpath(getenv('COMPONENTS_DIR'));
$headers = \shgysk8zer0\Core\Headers::getInstance();
$dom = \shgysk8zer0\DOM\HTML::getInstance();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom->body->class = 'flex column';
	call_user_func($dom->head, 'head');
	call_user_func($dom->body, 'header', 'main', 'footer');
	exit($dom);
} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {
	$resp = \shgysk8zer0\Core\JSON_Response::getInstance();
	if (array_key_exists('load', $_REQUEST)) {
		switch($_REQUEST['load']) {
			case 'readme':
				$readme = call_user_func($dom->body, 'readme')[0];
				$resp->append('body', $readme)->showModal("#{$readme->id}");
				break;
		}
	} else {
		$resp->log($_REQUEST);
	}
	$resp->send();
	exit();
} else {
	http_response_code(\shgysk8zer0\Core_API\Abstracts\HTTPStatusCodes::BAD_REQUEST);
}
