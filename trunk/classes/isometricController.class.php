<?php
/**
 * Isopix
 **
 * A project to create an isometric engine in PHP.
 **/
/**
 * isometricController.class.php
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
	function loadSpriteFromImage($spriteImage, $x = null, $y = null, $z = null, $addToImage = true) {
		$sprite = new Sprite;
		$sprite->imageResource = $this->loadSpriteImage($spriteImage);
		$sprite->width = imagesx($sprite->imageResource);
		$sprite->height = imagesy($sprite->imageResource);
		if(isset($x)) $sprite->x = $x;
		if(isset($y)) $sprite->y = $y;
		if(isset($z)) $sprite->z = $z;
		if($addToImage == true) $this->sprite[] = $sprite;
		return $sprite;
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
	 * loadSpritesFromTiles($spriteTiles, $spriteNames, $spriteGroup)
	 **
	 * $spriteTiles: The name of the image file containing the tiles.
	 * $spriteNames: The names of the sprites.
	 * $spriteGroup: The group that should be returned.
	 **/
	function loadSpritesFromTiles($spriteTiles, $spriteNames, $spriteGroup) {
		$tileImage = $this->loadSpriteImage($spriteTiles);
		$imageWidth = imagesx($tileImage);
		$imageHeight = imagesy($tileImage);
		$chunkSize = round($imageWidth / count($spriteNames));
		$chunkImages = array();
		for ($currentChunk=1;$currentChunk<count($spriteNames);$currentChunk++) {
			$chunkImages[$currentChunk - 1] = imagecreate($chunkSize, $imageHeight);
			$col = imagecolorallocate($chunkImages[$currentChunk - 1], 255,255,255);
			imagecolortransparent($chunkImages[$currentChunk - 1], $col);
			imagecopyresampled($chunkImages[$currentChunk - 1], $tileImage, 1, 1, $chunkSize * ($currentChunk - 1) + 1, 1, $chunkSize, $imageHeight, $chunkSize, $imageHeight);
		}
		$chunkImages[count($spriteNames) - 1] = imagecreate($chunkSize, $imageHeight);
		$col = imagecolorallocate($chunkImages[count($spriteNames) - 1], 0,0,0);
		imagecolortransparent($chunkImages[count($spriteNames) - 1], $col);
		imagecopyresampled($chunkImages[count($spriteNames) - 1], $tileImage, 1, 1, $chunkSize * (count($spriteNames)- 1) + 1, 1, $imageWidth, $imageHeight, $imageWidth, $imageHeight);
		for($i=0;$i<count($spriteNames);$i++) {
			$newSprite = new Sprite;
			$newSprite->imageResource = $chunkImages[$i];
			$newSprite->width = imagesx($newSprite->imageResource);
			$newSprite->height = imagesy($newSprite->imageResource);
			$spriteGroup->addSprite($newSprite, $spriteNames[$i]);
		}
		return $spriteGroup;
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
	 * loadSpriteImage($imagePath);
	 **
	 * Loads a sprite image file.
	 * $imagePath: the path to the image.
	 **/
	function loadSpriteImage($imagePath){
		switch(exif_imagetype($imagePath)) {
			case IMAGETYPE_GIF:
				return imagecreatefromgif($imagePath);
				break;
			case IMAGETYPE_JPEG:
				return imagecreatefromjpeg($imagePath);
				break;
			case IMAGETYPE_PNG:
				return imagecreatefrompng($imagePath);
				break;
			case IMAGETYPE_WBMP:
				return imagecreatefromwbmp($imagePath);
				break;
			case IMAGETYPE_XBM:
				return imagecreatefromxbm($imagePath);
				break;
		}
	}
	/**
	 * renderImage($displayCoords, $fileName, $outputHeader)
	 **
	 * $displayCoords: Display the coords printed on the final image.
	 * $fileName:      the filename of the output file.
	 * $outputHeader:  Display the headers.
	 * Returns nothing.
	 **/
	function renderImage($displayCoords = -2, $fileName = 0, $outputHeader = true) {
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
		if($outputHeader) header("Content-Type: image/gif");
		if($fileName) return imagegif($this->_outputImage, $fileName);
		imagegif($this->_outputImage);
	}
	function createHTMLMap($imageFile) {
		$mapID = md5(time().rand(1, 10000));
		$outputHTML = sprintf("<img src=\"%s\" usemap=\"%s\" border=\"0\" />\n", $imageFile, $mapID);
		$outputHTML .= sprintf("<map name=\"%s\">\n", $mapID);
		foreach ($this->sprite as $sprite) {
			$x = ($sprite->y % 2) ? ($sprite->x * $this->blockWidth) + ($this->blockWidth / 2) : ($sprite->x * ($this->blockWidth));
			$y = ($sprite->y * ($this->blockHeight)) - $sprite->z;
		 	$x = ($x - $sprite->width) + $this->blockWidth;
			$y = ($y - $sprite->height) + $this->blockHeight;
			$top = $bot = $left = $right = array();
			$top["x"] = $x + ($this->blockWidth / 2);
			$top["y"] = $y;
			$bot["x"] = $x + ($this->blockWidth / 2);
			$bot["y"] = $y + ($this->blockHeight * 2);
			$left["x"] = $x;
			$left["y"] = $y + $this->blockHeight;
			$right["x"] = $x + $this->blockWidth;
			$right["y"] = $y + $this->blockHeight;
			$coords = sprintf("%s,%s,%s,%s,%s,%s,%s,%s",(int) $top['x'],(int) $top['y'],(int) $right['x'],(int) $right['y'],(int) $bot['x'],(int) $bot['y'],(int) $left['x'],(int) $left['y']);
			if($sprite->url) $outputHTML .= sprintf("<area shape=\"polygon\" coords=\"%s\" href=\"%s\" border=\"1\" />", $coords, $sprite->url);
		}
		$outputHTML .= sprintf("</map>");
		return $outputHTML;
//<area shape="polygon" coords="19,44,45,11,87,37,82,76,49,98" href="http://www.trees.com/save.html">
	}
}
?>
