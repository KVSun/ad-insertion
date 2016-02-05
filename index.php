<?php
$console = \shgysk8zer0\Core\Console::getInstance()->asErrorHandler()->asExceptionHandler();
$headers = new \shgysk8zer0\Core\Headers();
if (in_array('text/html', explode(',', $headers->accept))) {
	$dom = new \shgysk8zer0\DOM\HTML();
	$dom->head->append('title', 'Ad Insertion');
	$dom->head->append('link', null, ['rel' => 'icon', 'href' => 'sun.svg', 'type' => 'image/svg+xml', 'sizes' => 'any']);
	$dom->head->append('link', null, ['rel' => 'stylesheet', 'href' => 'stylesheets/styles/import.css', 'media' => 'all']);
	$dom->head->append('script', null, ['type' => 'application/javascript', 'src' => 'scripts/inputdate.es6', 'defer' => true]);
	$dom->head->append('script', null, ['type' => 'application/javascript', 'src' => 'scripts/custom.es6', 'defer' => true]);
	$dom->head->append('meta', null, ['name' => 'description', 'content' => 'An ad insertion form for the Kern Valley Sun']);
	$dom->body->importHTML('<header><h1>KV Sun Ad Insertion</h1>
	</header>
	<main>
	<form name="ad-insertion" action="http://localhost" method="POST">
		<fieldset form="ad-insertion">
		<legend>Section</legend>
		<label for="ad-insertion[date]">Date: </label>
		<input type="date" name="ad-insertion[date]" id="ad-insertion[date]" placeholder="YYYY-mm-dd" required/>
		<label for="ad-insertion[by]">By: </label>
		<input type="text" name="ad-insertion[by]" id="ad-insertion[by]" pattern="[A-z ]+" required/>
		<br/>
		<label for="ad-insertion[section][a]">A</label>
		<input type="checkbox" name="ad-insertion[section]" id="ad-insertion[section][a]" value="a"/>
		<label for="ad-insertion[section][b]">B</label>
		<input type="checkbox" name="ad-insertion[section]" id="ad-insertion[section][b]" value="b"/>
		<label for="ad-insertion[section][c]">C</label>
		<input type="checkbox" name="ad-insertion[section]" id="ad-insertion[section][c]" value="c"/>
		<label for="ad-insertion[section][d]">D</label>
		<input type="checkbox" name="ad-insertion[section]" id="ad-insertion[section][d]" value="d"/>
		<label for="ad-insertion[classification]">Classification</label>
		<input type="text" name="ad-insertion[classification]" id="ad-insertion[classification]" required/>
		<label for="ad-insertion[special-edition]"><i>Special Edition</i></label>
		<input type="text" name="ad-insertion[special-edition]" id="ad-insertion[special-edition]"/>
		</fieldset>
		<fieldset form="ad-insertion">
		<legend>Contact Info</legend>
		<label for="ad-insertion[acct-name]">Account name: </label>
		<input type="text" name="ad-insertion[acct-name]" id="ad-insertion[acct-name]" required/><br/>
		<label for="ad-insertion[contact]">Contact: </label>
		<input type="text" name="ad-insertion[contact]" id="ad-insertion[contact]" pattern="[A-z \.]+" required/>
		<label for="ad-insertion[phone]">Phone: </label>
		<input type="tel" name="ad-insertion[phone]" id="ad-insertion[phone]" required/><br/>
		<label for="ad-insertion[address]">Address: </label>
		<input type="text" name="ad-insertion[address]" id="ad-insertion[address]" pattern="[\w \.]+" required/>
		</fieldset>
		<fieldset form="ad-insertion">
		<legend>Charges</legend>
		<label for="ad-insertion[rate]">Rate: </label>
		<input type="number" name="ad-insertion[rate]" id="ad-insertion[rate]" min="0" step="0.01" value="0" required/>
		<label for="ad-insertion[color-rate]">Color Rate: </label>
		<input type="number" name="ad-insertion[color-rate]" id="ad-insertion[color-rate]" min="0" step="0.01" value="0" required/>
		<label for="ad-insertion[q][full]">Full </label>
		<input type="radio" name="ad-insertion[q][full]" id="ad-insertion[q][full]" value="full"/>
		<label for="ad-insertion[q][1]">1 </label>
		<input type="radio" name="ad-insertion[q][1]" id="ad-insertion[q][1]" value="1"/>
		<label for="ad-insertion[q][2]">2 </label>
		<input type="radio" name="ad-insertion[q][2]" id="ad-insertion[q][2]" value="2"/><br/>
		<h2>Size</h2>
		<hr/>
		<label for="ad-insertion[size][width]">Width: </label>
		<input type="number" name="ad-insertion[size][width]" id="ad-insertion[size][width]" min="1" max="6" value="1" step="1" required/>
		<label for="ad-insertion[size][height]">Height: </label>
		<input type="number" name="ad-insertion[size][height]" id="ad-insertion[size][height]" min="1" max="21" value="1" step=".5" required/>
		<h2>Run dates:</h2>
		<hr/>
		<label for="ad-insertion[run][start]">From: </label>
		<input type="date" name="ad-insertion[run][start]" id="ad-insertion[run][start]" placeholder="YYYY-mm-dd" required/>
		<label for="ad-insertion[run][end]">To: </label>
		<input type="date" name="ad-insertion[run][end]" id="ad-insertion[run][end]" placeholder="YYYY-mm-dd" required/>
		<label for="ad-insertion[sheets]"><b><abbr title="Till Further Notice">TFN</abbr></b> Tear Sheets</label>
		<input type="text" name="ad-insertion[sheets]" id="ad-insertion[sheets]"/><br/>
		<label for="ad-insertion[pu]"><abbr title="Pick-Up">P/U</abbr></label>
		<input type="text" name="ad-insertion[pu]" id="ad-insertion[pu]"/>
	</fieldset>
	<label for="ad-insertion[info]">Ad Description &amp; Info</label><br/>
	<textarea name="ad-insertion[info]" id="ad-insertion[info]" required></textarea><br/>
	<label for="ad-insertion[attachments]">Attachments: </label>
	<input type="file" multiple/><br/>
	<button type="Submit">Submit</button>
	<button type="reset">Reset</button>
</form>
</main>
<footer>
	<dialog id="contact-dialog">
		<button type="button" data-close-modal="#contact-dialog">x</button><hr/>
		<a href="mailto:editor@kvsun.com" title="Email">
			<img src="images/octicons/svg/mail-read.svg" alt="Email" width="60" height="60"/>
		</a>
		<a href="https://gitter.im/KVSun/ad-insertion" target="_blank" title="Chat">
			<img src="images/octicons/svg/comment.svg" alt="Chat" width="60" height="60"/>
		</a>
		<a href="https://github.com/KVSun/ad-insertion/" target="_blank" title="GitHub">
			<img src="images/octicons/svg/mark-github.svg" alt="GitHub" width="60" height="60"/>
		</a>
		<a href="https://github.com/KVSun/ad-insertion/issues/new" target="_blank" title="Open Issue">
			<img src="images/octicons/svg/issue-opened.svg" alt="Open Issue" width="60" height="60"/>
		</a>
	</dialog>
	<a href="#contact-dialog" role="button">Contact</a>
</footer>');
exit($dom);
}
