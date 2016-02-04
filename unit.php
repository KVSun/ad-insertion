<?php
if (PHP_SAPI !== 'cli') {
	http_response_code(403);
	exit();
}
echo get_include_path() . PHP_EOL;
assert(true, 'This assert should pass.');
assert(false, 'This assert should fail');

exit(0);
