<?php
if (PHP_SAPI !== 'cli') {
	http_response_code(403);
	exit();
}
$timer = \shgysk8zer0\Core\Timer::load('Test');
assert(true, 'This assert should pass.');
assert(false, 'This assert should fail');

echo "Completed in $timer\n";
exit(0);
