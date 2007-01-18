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
$backgroundSprite = $isometricController->loadSpriteFromImage("sprites/tile_8.png", null, null, null, false);

/**
 * Setup the heightMap
 **/
$heightMap = new heightMap;
$heightMap->setMapSize(5,5);
$heightMap->setMapHeight(0);
$myMap = array();

/**
 * This is the actual heightMap
 * You may see it kinda represents the actual map
 **/
$heightMap->setHeightMap($myMap);

/**
 * Render the heightMap.
 **/
$heightMap = $heightMap->renderMap(new spriteCollection, $backgroundSprite, new spriteGroup);

/**
 * Place the heightMap (now a spriteCollection) on the isometric image.
 **/
$isometricController->loadSpriteFromCollection($heightMap);

$isometricController->loadSpriteFromImage("sprites/tile_1.png",  -1,0,0);
$isometricController->loadSpriteFromImage("sprites/tile_13.png", -1,1,0);
$isometricController->loadSpriteFromImage("sprites/tile_13.png", -1,2,0);
$isometricController->loadSpriteFromImage("sprites/tile_25.png", -1,3,0);
$isometricController->loadSpriteFromImage("sprites/tile_2.png",  0,0,0);
$isometricController->loadSpriteFromImage("sprites/tile_26.png",  0,3,0);
$isometricController->loadSpriteFromImage("sprites/tile_2.png",  1,0,0);
$isometricController->loadSpriteFromImage("sprites/tile_26.png",  1,3,0);
$isometricController->loadSpriteFromImage("sprites/tile_3.png",  2,0,0);
$isometricController->loadSpriteFromImage("sprites/tile_15.png", 2,1,0);
$isometricController->loadSpriteFromImage("sprites/tile_15.png", 2,2,0);
$isometricController->loadSpriteFromImage("sprites/tile_27.png", 2,3,0);
$isometricController->loadSpriteFromImage("sprites/tile_29.png", 0,1,0);
$isometricController->loadSpriteFromImage("sprites/tile_29.png", 0,2,0);
$isometricController->loadSpriteFromImage("sprites/tile_29.png", 1,1,0);
$isometricController->loadSpriteFromImage("sprites/tile_19.png", 1,1,0);
$isometricController->loadSpriteFromImage("sprites/tile_31.png", 1,2,0);
/*
tile_29.png//mid
tile_31.png//tree*/

/**
 * Render the whole image.
 **/
$isometricController->renderImage();
?>