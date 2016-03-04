<?php
namespace Components\Contact_Dialog;
use \shgysk8zer0\DOM\SVG as SVG;
function loadDialog()
{
	$size = ['height' => 60, 'width' => 60];
	$package = json_decode(file_get_contents('package.json'));
	$dialog = \shgysk8zer0\DOM\HTML::getInstance()->createElement('dialog');
	$dialog->id = 'contact-dialog';

	$dialog->append('button', null, [
		'type' => 'button',
		'data-close' => "#{$dialog->id}"
	]);
	$dialog->append('br');

	$dialog->append('a', null, [
		'href' => "mailto:{$package->author->email}",
		'title' => 'Email'
	])->import(SVG::useIcon('mail-read', $size), true);

	$dialog->append('a', null, [
		'href' => 'https://gitter.im/KVSun/ad-insertion',
		'target' => '_blank',
		'title' => 'Chat on Gitter'
	])->import(SVG::useIcon('comment', $size), true);

	$dialog->append('a', null, [
		'href' => str_replace('.git', null ,$package->repository->url),
		'target' => '_blank',
		'title' => 'GitHub'
	])->import(SVG::useIcon('mark-github', $size), true);

	$dialog->append('a', null, [
		'href' => $package->bugs->url,
		'target' => '_blank',
		'title' => 'Open Issue'
	])->import(SVG::useIcon('issue-opened', $size), true);
	return $dialog;
}
return loadDialog();
