<?php
/**
 * Isopix
 **
 * A project to create an isometric engine in PHP.
 **/
/**
 * spriteGroup.class.php
 **
 * spriteGroup allows you to create a single sprite with multiple images.
 **/
class spriteGroup {
	/**
	 * _sprites (array)
	 **
	 * a list of the sprites.
	 **/
	var $_sprites = array();
	/**
	 * addSprite($sprite, $name)
	 **
	 * $sprite: The sprite class object.
	 * $name:   The name of the sprite.
	 **/
	function addSprite($sprite, $name) {
		$this->_sprites[$name] = $sprite;
		return $name;
	}
	/**
	 * getSprite($name)
	 **
	 * $name: The name of the sprite to return
	 **/
	function getSprite($name) {
		if(isset($this->_sprites[$name])) return $this->_sprites[$name];
		return false;
	}
	
	/**
	 * repackSprites($function);
	 **
	 * $function : prefix for "sort" function used to pack the sprites
	 * Returns the new order of the sprites.
	 */
	function repackSprites($function) {
		$function = $function . "sort";
		return $this->_sprites = $function($this->_sprites);
	}
}
?>
