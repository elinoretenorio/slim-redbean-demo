<?php
/**
 * Slim+RedBean Demo
 *
 * @author      Elinore Tenorio <elinore.tenorio@gmail.com>
 * @license     MIT
 * @url         http://www.jobskee.com
 */
 
function safeText($text) {
	echo nl2br(htmlentities($text, ENT_QUOTES, 'UTF-8'));
}

function showLinks() {
	$base_url = BASE_URL;
	$pages = R::findAll('pages');
	echo "<a href=\"{$base_url}\">Home</a> ";
	foreach ($pages as $page) {
		echo "<a href=\"/{$page['url']}\">{$page['name']}</a> ";
	}
}