<?php
if (PHP_SAPI !== 'cli') {
	http_response_code(403);
	exit();
}
if (! function_exists('php_check_syntax')) {
	function php_check_syntax($filename, &$error_message)
	{
		$out = [];
		$error_message = exec(sprintf('php -l %s', escapeshellarg($filename)), $out, $return_var);
		return $return_var !== false;
	}
}
require('./autoloader.php');
$timer = new \shgysk8zer0\Core\Timer();
assert('$timer instanceof \shgysk8zer0\Core\Timer', 'Timer class not loaded.');
$clean_syntax = php_check_syntax('index.php', $syntax_errors);
assert($clean_syntax, $syntax_errors);
