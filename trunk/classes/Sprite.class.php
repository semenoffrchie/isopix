<?php
/**
 * Isopix
 **
 * A project to create an isometric engine in PHP.
 **/
/**
 * Sprite.class.php
 **
 * Sprite is the main class for all Sprite based activity.
 **/
class Sprite {
 	/**
	 * imageResource (mixed)
	 **
	 * This contains the resource for the sprite image.
	 **/
	var $imageResource = null;
 	/**
	 * width (int)
	 **
	 * The width of the sprite (pixels).
	 **/
	var $width = 0;
 	/**
	 * height (int)
	 **
	 * The height of the sprite (pixels).
	 **/
	var $height = 0;
 	/**
	 * x (int)
	 **
	 * The x position of the sprite (blocks)
	 **/
	var $x = 0;
 	/**
	 * y (int)
	 **
	 * The y position of the sprite (blocks)
	 **/
	var $y = 0;
 	/**
	 * z (int)
	 **
	 * The z position of the sprite (blocks)
	 **/
	var $z = 0;
 	/**
	 * visible (bool)
	 **
	 * Is the sprite visible?
	 **/
	var $visible = true;
	/**
	 * _params (array)
	 **
	 * A list of all the vars defined in this class,
	 * Used in :copySprite
	 **/
	var $_params = array("imageResource", "width", "height", "x", "y", "z", "visible");
}
?>
