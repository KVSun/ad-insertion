<?php
require_once './functions.php';
$console = \shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
$headers = new \shgysk8zer0\Core\Headers();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom = \shgysk8zer0\DOM\HTML::getInstance();
	$dom->body->class = 'flex column';
	\KVSun\load('head', 'header', 'main', 'forms/ad-insertion', 'footer');
	exit($dom);
} elseif ($headers->accept === 'application/json' and !empty($_REQUEST)) {
	$resp = \shgysk8zer0\Core\JSON_Response::load();
	if (array_key_exists('load', $_REQUEST)) {
		switch($_REQUEST['load']) {
			case 'readme':
				$parsedown = new \Parsedown\Parsedown();

				$dom = \shgysk8zer0\DOM\HTML::getInstance();
				$readme = $dom->body->append('dialog', null, ['id' => 'README-dialog']);
				$readme->append('button', null, [
					'type' => 'button',
					'data-delete' => "#{$readme->id}"
				]);
				$readme->append('br');
				$readme->importHTML($parsedown->text(file_get_contents('README.md')));
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
