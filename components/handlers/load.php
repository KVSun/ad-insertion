<?php
namespace Components\Handlers\Load;
const ERROR_FORMAT = 'Do not know how to load "%s"';

/**
 * [load_request description]
 * @param  [type] $request [description]
 * @return [type]          [description]
 */
function load_request($request)
{
	$resp = \shgysk8zer0\Core\JSON_Response::getInstance();
	$dom = \shgysk8zer0\DOM\HTML::getInstance();
	switch($request) {
		case 'readme':
			$readme = call_user_func($dom->body, 'readme')[0];
			$resp->append('body', $readme)->showModal("#{$readme->id}");
			break;

		case 'ad_insertion':
			$dialog = $dom->body->append('dialog', null, ['id' => 'ad-insertion-dialog']);
			$dialog->append('button', null, ['data-delete' => "#{$dialog->id}"]);
			$dialog->append('button', null, [
				'type' => 'button',
				'data-fullscreen' => "#{$dialog->id}"
			]);
			$dialog->append('br');
			$dialog('forms/ad_insertion');
			$resp->append('body', $dialog)->showModal("#{$dialog->id}");
			break;

		default:
			$resp->notify(
				'Unhandled request',
				sprintf(ERROR_FORMAT, $_REQUEST['load']),
				'images/octicons/svg/bug.svg'
			)->error(['$_REQUEST' => $_REQUEST]);
			\shgysk8zer0\Core\Console::getInstance()->error(sprintf(ERROR_FORMAT, $_REQUEST['load']));
	}

}
load_request($_REQUEST['load']);
