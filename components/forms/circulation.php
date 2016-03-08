<?php
namespace Components\Forms\Circulation;

use \shgysk8zer0\DOM as DOM;
use \shgysk8zer0\Core_API\Abstracts\RegExp as Pattern;

return function()
{
	$size = ['width' => 30, 'height' => '30'];
	$form = DOM\HTML::getInstance()->createElement('form');
	$form->name = basename(__FILE__, '.php');
	$form->method = 'POST';
	$form->action = '.';

	$contact = $form->append('fieldset');
	$contact->append('Legend', 'Contact Info');
	$label = $contact->append('label', 'Name');
	$input = $contact->append('input', null, [
		'type'        => 'text',
		'name'        => "{$form->name}[contact][name]",
		'id'          => "{$form->name}[contact][id]",
		'placeholder' => 'Some Body',
		'pattern'     => Pattern::TEXT,
		'required'    => ''
	]);
	$label->for = $input->id;

	$contact->append('br');

	$label = $contact->append('label', 'Phone');
	$input = $contact->append('input', null, [
		'type'        => 'tel',
		'name'        => "{$form->name}[contact][tel]",
		'id'          => "{$form->name}[contact][tel]",
		'placeholder' => '1234567890',
		'pattern'     => Pattern::TEL,
		'required'    => ''
	]);
	$label->for = $input->id;

	$label = $contact->append('label', 'Ext.');
	$input = $contact->append('input', null, [
		'type'        => 'number',
		'name'        => "{$form->name}[contact][ext]",
		'id'          => "{$form->name}[contact][ext]",
		'min'         => 0,
		'max'         => 9999,
		'placeholder' => '####',
		'pattern'     => '\d{1,4}'
	]);
	$label->for = $input->id;
	$contact->append('br');

	$label = $contact->append('label', 'Email');
	$input = $contact->append('input', null, [
		'type'        => 'email',
		'name'        => "{$form->name}[contact][email]",
		'id'          => "{$form->name}[contact][email]",
		'placeholder' => 'user@example.com',
		'pattern'     => Pattern::EMAIL,
		'required'    => ''
	]);
	$label->for = $input->id;

	unset($contact);

	$address = $form->append('fieldset');
	$address->append('legend', 'Delivery');
	$label = $address->append('label', 'Address');
	$input = $address->append('input', null, [
		'type'        => 'text',
		'name'        => "{$form->name}[address][name]",
		'id'          => "{$form->name}[address][name]",
		'placeholder' => '123 Some St.',
		'pattern'     => '[\w \.#]+',
		'required'    => ''
	]);
	$label->for = $input->id;

	$label = $address->append('label', 'City');
	$input = $address->append('input', null, [
		'type'        => 'text',
		'name'        => "{$form->name}[address][city]",
		'id'          => "{$form->name}[address][city]",
		'placeholder' => 'Lake Isabella',
		'pattern'     => '[A-z \.]+',
		'required'    => ''
	]);
	$label->for = $input->id;
	$address->append('br');

	$label = $address->append('label', 'State');
	$input = $address->append('input', null, [
		'type'        => 'text',
		'name'        => "{$form->name}[address][state]",
		'id'          => "{$form->name}[address][state]",
		'placeholder' => 'California',
		'pattern'     => '[A-z\.]+',
		'required'    => ''
	]);
	$label->for = $input->id;

	$label = $address->append('label', 'Zip');
	$input = $address->append('input', null, [
		'type'        => 'number',
		'name'        => "{$form->name}[address][zip]",
		'id'          => "{$form->name}[address][zip]",
		'placeholder' => '#####',
		'min'         => 10000,
		'max'         => 99999,
		'maxlength'   => 4,
		'required'    => ''
	]);
	$label->for = $input->id;

	unset($address, $label, $input);

	$form->append('hr');

	$form->append('button', null, [
		'type'  => 'submit',
		'title' => 'Submit'
	])->import(DOM\SVG::useIcon('check', $size));

	$form->append('button', null, [
		'type'  => 'reset',
		'title' => 'reset'
	])->import(DOM\SVG::useIcon('x', $size));

	return $form;
};
