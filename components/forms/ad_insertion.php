<?php
namespace Components\Forms\Ad_Insertion;

use \shgysk8zer0\DOM as DOM;
use \shgysk8zer0\Core as Core;
use \shgysk8zer0\Core_API\Abstracts\RegExp as Pattern;

return function()
{
	$date = new Core\DateTime();
	$date->format = 'Y-m-d';
	$size = ['width' => 30, 'height' => 30];

	$dom = DOM\HTML::getinstance();
	$functions = Core\NamespacedFunction::load('\Functions');

	$form = $dom->createElement('form');
	$form->name = basename(__FILE__, '.php');
	$form->action = '.';
	$form->method = 'POST';

	$cities = array_reduce([
		'Lake Isabella',
		'Wofford Heights',
		'Bodfish',
		'Kernville',
		'South Lake',
		'Weldon',
		'Bakersfield'
	], $functions->add_datalist_item, $form->append('datalist', null, ['id' => 'city-list']));

	$section = $form->append('fieldset', null, ['form' => $form->name]);
	$section->append('legend', 'Section');
	$label = $section->append('label', 'Date: ');
	$input = $section->append('input', null, [
		'type' => 'date',
		'name' => "{$form->name}[date]",
		'id' => "{$form->name}[date]",
		'placeholder' => 'YYYY-mm-dd',
		'min' => $date,
		'value' => $date,
		'pattern' => Pattern::DATE,
		'require' => true
	]);
	$label->for = $input->id;

	$date->format = 'Y-\WW';
	$label = $section->append('label', 'By: ');
	$input = $section->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[by]",
		'id' => "{$form->name}[by]",
		'pattern' => '[A-z ]+',
		'placeholder' => 'Your name',
		'required' => true
	]);
	$label->for = $input->id;
	$section->append('br');

	$label = $section->append('label', 'A');
	$input = $section->append('input', null, [
		'type' => 'checkbox',
		'name' => "{$form->name}[section][a]",
		'id' => "{$form->name}[section][a]"
	]);
	$label->for = $input->id;
	$label = $section->append('label', 'B');
	$input = $section->append('input', null, [
		'type' => 'checkbox',
		'name' => "{$form->name}[section][b]",
		'id' => "{$form->name}[section][b]"
	]);
	$label->for = $input->id;
	$label = $section->append('label', 'C');
	$input =$section->append('input', null, [
		'type' => 'checkbox',
		'name' => "{$form->name}[section][c]",
		'id' => "{$form->name}[section][c]"
	]);
	$label->for = $input->id;
	$label = $section->append('label', 'D');
	$input = $section->append('input', null, [
		'type' => 'checkbox',
		'name' => "{$form->name}[section][d]",
		'id' => "{$form->name}[section][d]"
	]);
	$label->for = $input->id;
	$label = $section->append('label',' Classification');
	$input = $section->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[classification]",
		'id' => "{$form->name}[classification]",
		'placeholder' => '???',
		'required' => true
	]);
	$label->for = $input->id;
	$label = $section->append('label', null, [
		'for' => "{$form->name}[special-edition]"
	])->append('i', 'Special Edition');
	$input = $section->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[special-edition]",
		'placeholder' => '???',
		'id' => "{$form->name}[special-edition]"
	]);
	$label->for = $input->id;
	unset($section);

	$contact = $form->append('fieldset', null, ['form' => $form->name]);
	$contact->append('legend', 'Contact Info');
	$label = $contact->append('label', 'Account name: ');
	$input = $contact->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[acct-name]",
		'id' => "{$form->name}[acct-name]",
		'pattern' => '[\w ]+',
		'placeholder' => 'Business name',
		'required' => ''
	]);
	$label->for = $input->id;
	$contact->append('br');

	$label = $contact->append('label', 'Contact: ');
	$input = $contact->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[contact]",
		'id' => "{$form->name}[contact]",
		'placeholder' => 'First Last',
		'pattern' => '[A-z \.]+',
		'required' => ''
	]);
	$label->for = $input->id;
	$label = $contact->append('label', 'Phone: ');
	$input = $contact->append('input', null, [
		'type' => 'tel',
		'name' => "{$form->name}[phone]",
		'id' => "{$form->name}[phone]",
		'placeholder' => '123456789',
		'pattern' => Pattern::TEL,
		'required' => ''
	]);
	$label->for = $input->id;
	$contact->append('br');

	$label = $contact->append('label', 'Address: ');
	$input = $contact->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[address]",
		'id' => "{$form->name}[address]",
		'pattern' => '[\w \.]+',
		'placeholder' => '123 Easy St.',
		'required' => ''
	]);
	$label->for = $input->id;

	$label = $contact->append('label', 'City');
	$input = $contact->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[city]",
		'id' => "{$form->name}[city]",
		'list' => 'city-list',
		'placeholder' => 'City Name',
		'pattern' => '[A-z \.]+',
		'required' => ''
	]);
	$label->for = $input->id;
	unset($contact);

	$charges = $form->append('fieldset', null, ['form' => $form->name]);
	$charges->append('legend', 'Charges');
	$label = $charges->append('label', 'Rate: ');
	$input = $charges->append('input', null, [
		'type' => 'number',
		'name' => "{$form->name}[rate]",
		'id' => "{$form->name}[rate]",
		'min' => '0',
		'step' => 0.01,
		'value' => '0',
		'placeholder' => '50.00',
		'required' => ''
	]);
	$label->for = $input->id;
	$label = $charges->append('label', 'Color Rate: ');
	$input = $charges->append('input', null, [
		'type' => 'number',
		'name' => "{$form->name}[color-rate]",
		'id' => "{$form->name}[color-rate]",
		'min' => '0',
		'step' => 0.01,
		'value' => '0',
		'placeholder' => 5.25,
		'required' => ''
	]);
	$label->for = $input->id;

	$label = $charges->append('label', 'Full ');
	$input = $charges->append('input', null, [
		'type' => 'radio',
		'name' => "{$form->name}[q]",
		'id' => "{$form->name}[q][full]",
		'value' => 'full',
		'placeholder' => '???'
	]);
	$label->for = $input->id;
	$label = $charges->append('label', '1 ');
	$input = $charges->append('input', null, [
		'type' => 'radio',
		'name' => "{$form->name}[q]",
		'id' => "{$form->name}[q][1]",
		'value' => '1'
	]);
	$label->for = $input->id;
	$label = $charges->append('label', '2 ');
	$input = $charges->append('input', null, [
		'type' => 'radio',
		'name' => "{$form->name}[q]",
		'id' => "{$form->name}[q][2]",
		'value' => '2'
	]);
	$label->for = $input->id;
	$charges->append('br');

	$charges->append('h2', 'Size');
	$charges->append('hr');

	$label = $charges->append('label', 'Width: ');
	$input = $charges->append('input', null, [
		'type' => 'number',
		'name' => "{$form->name}[size][width]",
		'id' => "{$form->name}[size][width]",
		'min' => '1',
		'max' => '6',
		'step' => '1',
		'placeholder' => 3,
		'required' => ''
	]);
	$label->for = $input->id;
	$label = $charges->append('label', 'Height: ');
	$input = $charges->append('input', null, [
		'type' => 'number',
		'name' => "{$form->name}[size][height]",
		'id' => "{$form->name}[size][height]",
		'min' => '1',
		'max' => '21',
		'step' => '0.5',
		'placeholder' => 5,
		'required' => ''
	]);
	$label->for = $input->id;

	$charges->append('h2', 'Run Dates');
	$charges->append('hr');
	$label = $charges->append('label', 'From: ');
	$input = $charges->append('input', null, [
		'type' => 'week',
		'name' => "{$form->name}[run][start]",
		'id' => "{$form->name}[run][start]",
		'placeholder' => 'YYYY-W##',
		'min' => $date,
		'value' => $date,
		'required' => ''
	]);
	$label->for = $input->id;
	$label = $charges->append('label', 'To: ');
	$input = $charges->append('input', null, [
		'type' => 'week',
		'name' => "{$form->name}[run][end]",
		'id' => "{$form->name}[run][end]",
		'min' => $date,
		'value' => $date->modify('+1 week'),
		'placeholder' => 'YYYY-W##',
		'required' => ''
	]);
	$label->for = $input->id;
	$label = $charges->append('label', null);
	$label->append('b')->append('abbr', 'TFN', ['title' => 'Tile Further Notice']);
	$input = $charges->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[sheets]",
		'id' => "{$form->name}[sheets]",
		'placeholder' => '???'
	]);
	$label->for = $input->id;
	$charges->append('br');

	$label = $charges->append('label', null);
	$label->append('abbr', 'P/U', ['title' => 'Pick-Up']);
	$input = $charges->append('input', null, [
		'type' => 'text',
		'name' => "{$form->name}[pu]",
		'id' => "{$form->name}[pu]",
		'placeholder' => '???'
	]);
	$label->for = $input->id;
	unset($charges);

	$info = $form->append('fieldset');
	$info->append('legend', 'Ad Description &amp; Info');
	$info->append('br');

	$info->append('textarea', null, [
		'name' => "{$form->name}[info]",
		'id' => "{$form->name}[info]",
		'placeholder' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec a diam lectus. Sed sit amet ipsum mauris. Maecenas congue ligula ac quam viverra nec consectetur ante hendrerit. Donec et mollis dolor. Praesent et diam eget libero egestas mattis sit amet vitae augue. Nam tincidunt congue enim, ut porta lorem lacinia consectetur. Donec ut libero sed arcu vehicula ultricies a non tortor.',
		'required' => ''
	]);
	$info->append('br');

	$label = $info->append('label', 'Attachments: ');
	$input = $info->append('input', null, [
		'type' => 'file',
		'name' => "{$form->name}[attachments]",
		'id' => "{$form->name}[attachments]"
	]);
	$label->for = $input->id;
	unset($info);

	$form->append('button', null, [
		'type' => 'submit',
		'title' => 'Submit'
		])->import(DOM\SVG::useIcon('check', $size));
	$form->append('button', null, [
		'type' => 'reset',
		'title' => 'Reset'
		])->import(DOM\SVG::useIcon('x', $size));
	$form->append('hr');
	return $form;
};
