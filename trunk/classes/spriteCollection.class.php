<?php
/**
 * OnlineTTD
 **
 * A project by Peter Corcoran, OnlineTTD aims to recreate the
 * classic game 'Transport Tycoon Deluxe' in a PHP Web-based game.
 **/
/**
 * spriteCollection.class.php
 **
 * spriteCollection manages a collection of sprites.
 **/
class spriteCollection {
	/**
	 * _sprites (array)
	 **
	 * An internal var, for storing the sprites
	 **/
 	var $_sprites = array();
 	/**
 	 * addSprite($collectionSprite, [arrays of x,y,z coord])
 	 **
 	 * $collectionSprite: The sprite OBJECT for the collection.
 	 * [arrays]         : array(x, y, z), array(x, y, z)...
 	 **/
 	function addSprite() {
		$arguments = func_get_args();
		$collectionSprite = $arguments[0];
		array_shift($arguments);
		foreach($arguments as $coords) $this->_sprites[] = array($collectionSprite, $coords[0], $coords[1], $coords[2]);
	}
}
?>