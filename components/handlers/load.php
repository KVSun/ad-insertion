<?php
$resp = \shgysk8zer0\Core\JSON_Response::getInstance();
$dom = \shgysk8zer0\DOM\HTML::getInstance();
switch($_REQUEST['load']) {
	case 'readme':
		$readme = call_user_func($dom->body, 'readme')[0];
		$resp->append('body', $readme)->showModal("#{$readme->id}");
		break;

	case 'ad-insertion':
		$dialog = $dom->body->append('dialog', null, ['id' => 'ad-insertion-dialog']);
		$dialog->append('button', null, ['data-delete' => "#{$dialog->id}"]);
		$dialog->append('button', null, [
			'type' => 'button',
			'data-fullscreen' => "#{$dialog->id}"
		]);
		$dialog->append('br');
		$dialog('forms/ad-insertion');
		$resp->append('body', $dialog)->showModal("#{$dialog->id}");
}
