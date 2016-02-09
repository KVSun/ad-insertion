<?php
$footer = $dom->body->append('footer');
$footer->append('button', 'Contact', ['data-show-modal' => '#contact-dialog']);
require_once './components/contact-dialog.php';
