<?php
if (PHP_SAPI !== 'CLI') {
	http_response_code(403);
	exit();
}
$timer = \shgysk8zer0\Core\Timer::load('Test');

echo $timer;
exit(0);
