<?php
putenv('MIN_PHP_VERSION=5.5');
putenv('AUTOLOAD_DIR=classes');
putenv('AUTOLOAD_FUNC=spl_autoload');
putenv('AUTOLOAD_EXTS=.php');
require_once './autoloader.php';
$icons = json_decode(file_get_contents('images/icons.json'), true);
$sprites = new \shgysk8zer0\DOM\SVGSprite($icons);
$sprites->save('images/icons.svg');
