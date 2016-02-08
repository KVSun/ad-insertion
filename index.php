<?php
$console = \shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
$headers = new \shgysk8zer0\Core\Headers();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom = new \shgysk8zer0\DOM\HTML();
	$dom->body->class = 'flex column';
	require_once './components/head.php';
	require_once './components/header.php';
	require_once './components/main.php';
	require_once './components/forms/ad-insertion.php';
	require_once './components/footer.php';
	exit($dom);
} elseif ($headers->accept === 'application/json') {
	$headers->content_type = 'application/json';
	exit(json_encode(['post' => $_POST, 'file' => $_FILES]));
}
