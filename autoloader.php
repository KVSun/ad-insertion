<?php
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
	});
} else {
	assert_options(ASSERT_ACTIVE, false);
	assert_options(ASSERT_BAIL, false);
	assert_options(ASSERT_WARNING, false);
}
