<?php
namespace Components\Handlers\Load;
const ERROR_FORMAT = 'Do not know how to load "%s"';

function load_form($name)
{
	$name   = str_replace('-', '_', strtolower($name));
	$dom    = \shgysk8zer0\DOM\HTML::getInstance();
	$resp   = \shgysk8zer0\Core\JSON_Response::getInstance();
	$dialog = $dom->body->append('dialog', null, ['id' => "{$name}-dialog"]);

	$dialog->append('button', null, ['data-delete' => "#{$dialog->id}"]);
	$dialog->append('button', null, [
		'type' => 'button',
		'data-fullscreen' => "#{$dialog->id}"
	]);
	$dialog->append('br');
	$dialog("forms/{$name}");
	return $resp->append('body', $dialog)->showModal("#{$dialog->id}");
}

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
			return $resp->append('body', $readme)->showModal("#{$readme->id}");
			break;

		case 'ad_insertion':
			return load_form('ad_insertion');
			break;

		case 'login':
			return load_form('login');
			break;

		default:
			\shgysk8zer0\Core\Console::getInstance()->error(sprintf(ERROR_FORMAT, $request));
			return $resp->notify(
				'Unhandled request',
				sprintf(ERROR_FORMAT, $_REQUEST['load']),
				'images/octicons/svg/bug.svg'
			)->error(['$_REQUEST' => $_REQUEST]);
	}

}
return load_request($_REQUEST['load']);
