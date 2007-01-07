<?php
/**
 * Isopix
 **
 * A project to create an isometric engine in PHP.
 **/
/**
 * heightMap.class.php
 **
 * heightMap manages all heightMap activity.
 **/
class heightMap {
	/**
	 * heightMap (array)
	 **
	 * Used internally to store the actual height map.
	 **/
 	var $_heightMap = array();
 	
	/**
	 * _x (int)
	 **
	 * Used internally to store the size of the map.
	 **/
 	var $_x = 18;
 	
 	/**
 	 * _y
 	 **
 	 * Used internally to store the size of the map.
 	 **/
 	var $_y = 18;
 	
 	/**
 	 * _x
 	 **
 	 * Used internally to store the default Z height.
 	 **/
 	var $_z = 0;
 	
 	/**
 	 * setMapHeight($z)
 	 **
 	 * $z: The new default Z height of the map.
 	 **/
 	function setMapHeight($z) {
		$this->_z = (int) $z;
		return $this->_z;
	}
	
 	/**
 	 * setMapSize($x, $y);
 	 **
 	 * $x: The X size of the map.
 	 * $y: The Y size of the map.
 	 **/
 	function setMapSize($x, $y) {
		$this->_x = (int) $x;
		$this->_y = (int) $y;
		return array($this->_x, $this->_y);
	}
	
 	/**
 	 * setHeightMap($heightMap);
 	 **
 	 * $heightMap: The height map you wish to use.
 	 **/
 	function setHeightMap($heightMap = "") {
		if(isset($heightMap)) $this->_heightMap = $heightMap;
		return $this->_heightMap;
	}
	
 	/**
 	 * renderMap($spriteCollection, $backgroundSprite, $slopeSprite);
 	 **
 	 * $spriteCollection: The sprite OBJECT for the spriteCollection.
 	 * $backgroundSprite: The sprite to use as the background.
 	 * $slopeSprite:      A group of sprites for the slopes.
 	 **/
 	function renderMap($spriteCollection, $backgroundSprite, $slopeSprite) {
 		for($x=$this->_x;$x>=0;$x--) {
			for($y=$this->_y;$y>=0;$y--){
				if(!isset($this->_heightMap[$x][$y])) {
					$spriteCollection->addSprite($backgroundSprite, array($x - 1, $y, $this->_z));
			 	} elseif(is_int($this->_heightMap[$x][$y])) {
					$spriteCollection->addSprite($backgroundSprite, array($x - 1, $y, $this->_heightMap[$x][$y]));
				} else {
					list($spriteName, $zLocation) = $this->_heightMap[$x][$y];
					$spriteCollection->addSprite($slopeSprite->getSprite($spriteName), array($x - 1, $y, $zLocation));
				}
			}
		}
		return $spriteCollection;
	}
}
?>
