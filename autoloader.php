<?php
if (version_compare(PHP_VERSION, getenv('MIN_PHP_VERSION'), '<')) {
	header('Content-Type: text/plain');
	http_response_code(500);
	exit('PHP version ' . getenv('MIN_PHP_VERSION') . ' or greater is required');
}
set_include_path(realpath(getenv('CONFIG_DIR')) . PATH_SEPARATOR . get_include_path());
spl_autoload_register(getenv('AUTOLOAD_FUNC'));
spl_autoload_extensions(getenv('AUTOLOAD_EXTS'));
if (PHP_SAPI === 'cli') {
	assert_options(ASSERT_ACTIVE, true);
	assert_options(ASSERT_BAIL, true);
	assert_options(ASSERT_WARNING, false);
	assert_options(ASSERT_CALLBACK, function($script, $line, $message = null)
	{
		echo sprintf('Assert failed on %s:%u with message "%s"', $script, $line, $message);
		exit(1);
	});
} else {
	assert_options(ASSERT_ACTIVE, false);
	assert_options(ASSERT_BAIL, false);
	assert_options(ASSERT_WARNING, false);
}
