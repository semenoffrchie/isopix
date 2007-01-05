<?php
/**
 * OnlineTTD
 **
 * A project by Peter Corcoran, OnlineTTD aims to recreate the
 * classic game 'Transport Tycoon Deluxe' in a PHP Web-based game.
 **/
/**
 * displayCode.class.php
 **
 * This file contains code for highlight PHP code, mainly used in debugging features
 * and for placeholder files.
 **/
class displayCode {
	/**
	 * displayCode($file)
	 **
	 * $file: the path to the file that needs to be highlighted.
	 * Returns nothing.
	 **/
	function displayCode($file) {
		for($n=1, $lines=""; $n <= count(file($file)); $n++) $lines .= $n . "<br />";
		print("<table><tr><td><code>" . $lines . "</code></td><td>" . highlight_file($file, TRUE) . "</td></tr></table>");
	}
}
?>