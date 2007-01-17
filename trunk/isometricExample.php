<?php
/**
 * Include needed classes.
 * isometricController MUST be loaded last, as it may attempt to load from other classes.
 * Revision 13: It doesn't at this moment, but to remain future proof please load last.
 *              As in newer revisions it may load from other classes.
 **/
include "classes/displayCode.class.php";
include "classes/Sprite.class.php";
include "classes/spriteGroup.class.php";
include "classes/spriteCollection.class.php";
include "classes/heightMap.class.php";
include "classes/isometricAnimater.class.php";
include "classes/isometricController.class.php";

/**
 * These four lines allow you to add ?viewsource to the URL and view the source.
 **/
if(isset($_GET['viewsource'])) {
	new displayCode(__FILE__);
	exit;
}

/**
 * Create the isometricController
 * Needed to power the whole script.
 **/
$isometricController = new isometricController;
$isometricAnimater = new isometricAnimater;

/**
 * Create the background sprite
 * Basicly loads the background from 'bg.gif'
 * The 'null' means it doesn't have a x,y,z co-ord,
 * The 'true' means just return the Sprite object without adding to final image.
 **/
$backgroundSprite = $isometricController->loadSpriteFromImage("sprites/bg.gif", null, null, null, false);

/**
 * Create the slope sprites.
 **/
$slopeGroup = $isometricController->loadSpritesFromTiles("sprites/slope.gif", array("left", "right"), new spriteGroup);

/**
 * Setup the heightMap
 **/
$heightMap = new heightMap;
$heightMap->setMapSize(100,100);
$heightMap->setMapHeight(0);
$l1 = array("left", 1);
$l0 = array("left", 0);
$myMap = array();

/**
 * This is the actual heightMap
 * You may see it kinda represents the actual map
 **/
$myMap[] = array(  2,   2,   2,   2,   2,   2);
$myMap[] = array(  2,   2,   2,   2,   2,   2);
$myMap[] = array(  2,   2,   2,   2,   2,   2);
$myMap[] = array($l1, $l1, $l1, $l1, $l1, $l1);
$myMap[] = array($l0, $l0, $l0, $l0, $l0, $l0);
$heightMap->setHeightMap($myMap);

/**
 * Render the heightMap.
 **/
$heightMap = $heightMap->renderMap(new spriteCollection, $backgroundSprite, $slopeGroup);

/**
 * Place the heightMap (now a spriteCollection) on the isometric image.
 **/
$isometricController->loadSpriteFromCollection($heightMap);

/**
 * Build the track.
 **/
/*$trackSprite = $isometricController->loadSpriteFromImage("sprites/track.gif", null, null, null, false);
$track = new spriteCollection;
$track->addSprite($trackSprite, array(-1, 1 ,2), array(0, 2 ,2), array(0, 3 ,2), array(1,4,2), array(1,5,1), array(2,6,0), array(2,7,0), array(3,8,0), array(3,9,0), array(4,10,0), array(4,11,0), array(5,12,0), array(5,13,0), array(6,14,0), array(6,15,0), array(7,16,0));
$isometricController->loadSpriteFromCollection($track);
*/
/**
 * Render a train.
 * Co-ords:
 *   x: 4
 *   y: 10
 *   z: 0
 **/
$train = $isometricController->loadSpriteFromImage("sprites/train.gif", 4, 10, 0);

/**
 * Render a toy-town tree.
 * Co-ords:
 *   x: 0
 *   y: 3
 *   z: 2
 **/
$tree = $isometricController->loadSpriteFromImage("sprites/tree.gif", 0, 4, 2);

/**
 * Render the whole image.
 **/
if($_GET['animated'] == false) {
	$isometricController->renderImage(-2, "output.gif", false);
	$train->url = "javascript:alert('you clicked the train!')";
	$tree->url = "javascript:alert('you clicked the tree!')";
//	echo $isometricController->createHTMLMap("output.gif");
$isometricController->renderImage(0);
} else {
	$isometricAnimater->addFrame($isometricController);
	$tree->x = 3;
	$isometricAnimater->addFrame($isometricController);
	$isometricAnimater->renderImage();
}
?>