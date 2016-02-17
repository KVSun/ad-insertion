<?php
namespace KVSun
{
	function load()
	{
		static $dom, $headers, $console;
		if (is_null($dom)) {
			$dom = \shgysk8zer0\DOM\HTML::getInstance();
			$headers = \shgysk8zer0\Core\Headers::load();
			$console = \shgysk8zer0\Core\Console::getInstance();
		}
		$scripts = func_get_args();
		array_walk($scripts, function(&$script)
		{
			$script = __DIR__ . DIRECTORY_SEPARATOR . 'components' . DIRECTORY_SEPARATOR . $script;
			$ext = pathinfo($script, PATHINFO_EXTENSION);
			if (empty($ext)) {
				$script .= '.php';
			}
		});
		
		return array_map(function($script) use ($dom, $headers, $console)
		{
			return require $script;
		}, $scripts);
	}
}
