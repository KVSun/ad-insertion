<?php
namespace Components\Main
{
	/**
	 * Returns a link for a PHP search for an extension
	 *
	 * @param  string $extension The module name
	 * @return string            URL for search on PHP.net
	 */
	function getPHPLink($extension)
	{
		$params = new \shgysk8zer0\Core\URLSearchParams();
		$params->pattern = $extension;
		return "https://php.net/search.php?$params";
	}

	/**
	 * Create a <ul> of missing extensions with links to PHP.net
	 *
	 * @param  Array      $extensions Array of mising extensions
	 * @param  DOMElement $parent     Parent element to append list to
	 * @return DOMElement             The <ul>
	 */
	function listExtenions(Array $extensions, \DOMElement $parent)
	{
		if (! empty($extensions)) {
			return array_reduce($extensions, function(\DOMElement $list, $extension)
			{
				$li = $list->appendChild($list->ownerDocument->createElement('li'));
				$a = $li->appendChild($li->ownerDocument->createElement('a', $extension));
				$a->setAttribute('href', getPHPLink($extension));
				$a->setAttribute('target', '_blank');
				return $list;
			}, $parent->appendChild($parent->ownerDocument->createElement('ul')));
		}
	}

	/**
	 * Inverse of `extension_loaded`
	 *
	 * @param  string $name The extension name
	 * @return boolean      If it is not loaded
	 */
	function extension_not_loaded($name)
	{
		return ! extension_loaded($name);
	}

	$main = \shgysk8zer0\DOM\HTML::getInstance()->createElement('main');
	$extensions = array(
		'PDO',
		'dom',
		'fileinfo',
		'SPL',
		'session',
		'Reflection',
		'SimpleXML',
		'json',
		'mcrypt',
		'mysql',
		'mysqli',
		'pdo_mysql'
	);

	$extensions = array_filter($extensions, '\\' . __NAMESPACE__ . '\\extension_not_loaded');
	listExtenions($extensions, $main);
	unset($extensions);
	return $main;
}
