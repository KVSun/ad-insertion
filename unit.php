<?php
if (PHP_SAPI !== 'CLI') {
	http_response_code(403);
	exit();
}
exit(0);
