<?php
/**
 * OnlineTTD
 **
 * A project by Peter Corcoran, OnlineTTD aims to recreate the
 * classic game 'Transport Tycoon Deluxe' in a PHP Web-based game.
 **/
/**
 * isometricControler.class.php
 **
 * isometricController is the basic controller for all isometric
 * engine activity, the controller does all the rendering, sprite
 * loading and anything involving the isometric side of the engine.
 **/
class isometricController {
	/**
	 * blockWidth (int)
	 **
	 * This is the width (z) of the tiles/blocks (in pixels).
	 **/
	var $blockWidth = 64;
	/**
	 * blockHeight (int)
	 **
	 * This is the height/2 (y) of the tiles/blocks (in pixels).
	 **/
	var $blockHeight = 15.5;
	/**
	 * blockDepth (int)
	 **
	 * This is the depth (z) of the tiles/blocks (in pixels).
	 **/
	var $blockDepth = 7.75;
	/**
	 * sprite (array)
	 **
	 * The list of loaded sprites.
	 **/
 	var $sprite = array();
	/**
	 * _outputImage (mixed)
	 **
	 * An internal var used to store the output image.
	 **/
 	var $_outputImage = null;
	/**
	 * _loadedID (array)
	 **
	 * An internal var used to store all the loaded IDs.
	 **/
 	var $_loadedID = array();
	/**
	 * loadSpriteFromImage($spriteID, $x, $y)
	 **
	 * $spriteImage: The image path.
	 * $x:           Preload with X coord.
	 * $y:           Preload with Y coord.
	 * $z:           Preload with Z coord.
	 * Returns the index of the sprite in $->sprites[]
	 **/
	function loadSpriteFromImage($spriteImage, $x = null, $y = null, $z = null, $returnObject = false) {
		$sprite = new Sprite;
		$sprite->imageResource = imagecreatefromgif($spriteImage);
		$sprite->width = imagesx($sprite->imageResource);
		$sprite->height = imagesy($sprite->imageResource);
		if(isset($x)) $sprite->x = $x;
		if(isset($y)) $sprite->y = $y;
		if(isset($z)) $sprite->z = $z;
		if($returnObject == false) $this->sprite[] = $sprite;
		if($returnObject == false) return count($this->sprite) - 1;
		else                       return $sprite;
	}
	/**
	 * loadSpriteFromCollection($spriteCollection)
	 **
	 * $spriteCollection: The OBJECT of the spriteCollection
	 * Returns nothing.
	 **/
	function loadSpriteFromCollection($spriteCollection) {
		foreach($spriteCollection->_sprites as $sprite) {
		 	list($spriteObject, $x, $y, $z) = $sprite;
		 	$spriteObject->x = $x;
		 	$spriteObject->y = $y;
		 	$spriteObject->z = $z;
			$this->loadSpriteFromObject($spriteObject);
		}
	}
	/**
	 * loadSpriteFromGroup($spriteName, $spriteGroup)
	 **
	 * $spriteName:  The name of the sprite in the group
	 * $spriteGroup: The OBJECT of the spriteGroup
	 * Returns the index of the sprite in $->sprites[]
	 **/
	function loadSpriteFromGroup($spriteName, $spriteGroup) {
		$sprite = $spriteGroup->getSprite($spriteName);
		return $this->loadSpriteFromObject($sprite);
	}
	/**
	 * loadSpriteFromObject($spriteObject)
	 **
	 * $spriteObject: The OBJECT of the Sprite to add.
	 * Returns the index of the sprite in $->sprites[]
	 **/
	function loadSpriteFromObject($spriteObject) {
		$newSprite = new Sprite;
		foreach($newSprite->_params as $param) $newSprite->$param = $spriteObject->$param;
		$this->sprite[] = $newSprite;
		return count($this->sprite) - 1;
	}
	/**
	 * loadSpriteFromSprite($originalSprite, $x, $y)
	 **
	 * $originalSprite: The index of the original sprite.
	 * $x:              Preload with X coord.
	 * $y:              Preload with Y coord.
	 * $z:              Preload with Z coord.
	 * Returns the index of the sprite in $->sprites[]
	 **/
	function loadSpriteFromSprite($spriteId, $x = null, $y = null, $z = null) {
		if(!isset($this->sprite[$spriteId])) return false;
		$newSprite = new Sprite;
		foreach($newSprite->_params as $param) $newSprite->$param = $this->sprite[$spriteId]->$param;
		if(isset($x)) $newSprite->x = $x;
		if(isset($y)) $newSprite->y = $y;
		if(isset($z)) $newSprite->z = $z;
		$this->sprite[] = $newSprite;
		return count($this->sprite) - 1;
	}
	/**
	 * detectCollision()
	 **
	 * Detects for collisions (multiple sprites per tile) between sprites.
	 * Returns array(array(x-coord, y-coord)).
	 **/
	function detectCollision() {
		$locations = $detections = array();
		foreach ($this->sprite as $sprite) {
			if (in_array(array($sprite->x, $sprite->y), $locations)) $detections[] = array($sprite->x, $sprite->y);
			$locations[] = array($sprite->x, $sprite->y);
		}
		return $detections;
	} 	
	/**
	 * renderImage($displayCoords, $fileName)
	 **
	 * $displayCoords: Display the coords printed on the final image.
	 * $fileName:      the filename of the output file.
	 * Returns nothing.
	 **/
	function renderImage($displayCoords = -2, $fileName = 0) {
		$this->_outputImage = imagecreate(500, 250);
		imagecolorallocate($this->_outputImage, 255, 255, 255);
		$black = imagecolorallocate($this->_outputImage, 0, 0, 255);
		foreach ($this->sprite as $sprite) {
		 	$x = ($sprite->y % 2) ? ($sprite->x * $this->blockWidth) + ($this->blockWidth / 2) : ($sprite->x * ($this->blockWidth));
		 	$y = ($sprite->y * ($this->blockHeight)) - ($sprite->z * $this->blockDepth);
		 	$x = ($x - $sprite->width) + $this->blockWidth;
		 	$y = ($y - $sprite->height) + $this->blockHeight;
			if($sprite->visible) imagecopyresampled($this->_outputImage, $sprite->imageResource, $x, $y, 0, 0, $sprite->width, $sprite->height, $sprite->width, $sprite->height);
		}
		if($displayCoords != -2) {
			foreach ($this->sprite as $sprite) {
		 		$x = ($sprite->y % 2) ? ($sprite->x * $this->blockWidth) + ($this->blockWidth / 2) : ($sprite->x * ($this->blockWidth));
		 		$y = ($sprite->y * ($this->blockHeight)) - ($sprite->z * $this->blockDepth) + $sprite->z;
			 	$x = ($x - $sprite->width) + $this->blockWidth;
			 	$y = ($y - $sprite->height) + $this->blockHeight;
			 	if($sprite->z == $displayCoords || $displayCoords == -1) {
					imagestring($this->_outputImage, 2, ($x + 10), ($y + 9), $sprite->x . "," . $sprite->y, $black);
					imagestring($this->_outputImage, 2, 0, 22, "x,y", $black);
				}
			}
		}
		header("Content-Type: image/gif");
		if($fileName) return imagegif($this->_outputImage, $fileName);
		imagepng($this->_outputImage);
	}
}
?>
