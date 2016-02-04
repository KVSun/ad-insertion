<?php
if (PHP_SAPI !== 'cli') {
	http_response_code(403);
	exit();
}
require('./autoloader.php');
$timer = new \shgysk8zer0\Core\Timer();
assert('$timer instanceof \shgysk8zer0\Core\Timer', 'Timer class not loaded.');
