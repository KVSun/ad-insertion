<?php
namespace Components\Forms\Login;

return function()
{
	$form = \shgysk8zer0\DOM\HTML::getInstance()->createElement('form');
	$form->name = basename(__FILE__, '.php');
	$form->method = 'POST';
	$form->action = \shgysk8zer0\Core\URL::getInstance();
	$form->append('label', 'Email', ['for' => "{$form->name}[user]"]);
	$form->append('input', null, [
		'type' => 'email',
		'name' => "{$form->name}[user]",
		'id' => "{$form->name}[user]",
		'placeholder' => 'user@example.com',
		'required' => ''
	]);
	$form->append('br');
	$form->append('label', 'Password', ['for' => "{$form->name}[password]"]);
	$form->append('input', null, [
		'type' => 'password',
		'name' => "{$form->name}[password]",
		'id' => "{$form->name}[password]",
		'placeholder' => '************',
		'required' => ''
	]);
	$form->append('hr');
	$form->append('button', null, [
		'type' => 'submit',
		'title' => 'Submit'
	])->import(\shgysk8zer0\DOM\SVG::useIcon('check', [
		'height' => 30,
		'width' => 30
	]));
	$form->append('button', null, [
		'type' => 'reset',
		'title' => 'Reset'
	])->import(\shgysk8zer0\DOM\SVG::useIcon('x', [
		'height' => 30,
		'width' => 30
	]));
	return $form;
};
