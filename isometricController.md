# isometricController.class.php #
## Basic information ##
| **Class Name** | isometricController |
|:---------------|:--------------------|
| **File Name**  | isometricControler.class.php |
| **First Released** | 2nd January 2007    |
| **Description** | isometricController is the basic controller for all isometric engine activity, the controller does all the rendering, sprite loading and anything involving the isometric side of the engine. |
| **Completed**  | 37%                 |

## Class Demo ##
```
<?php
/* Please see isometricExample.php in the download for an example */
?>
```

## Class documentation ##
**Functions defined in this class:**
| loadSpriteFromCollection($spriteCollection); | Loads a [Sprite](Sprite.md) from a [spriteCollection](spriteCollection.md) |
|:---------------------------------------------|:---------------------------------------------------------------------------|
| loadSpriteFromGroup($spriteName, $spriteGroup); | Loads a [Sprite](Sprite.md) from a [spriteGroup](spriteGroup.md)           |
| loadSpriteFromObject($spriteObject);         | Loads a [Sprite](Sprite.md) from a [Sprite](Sprite.md) object              |
| loadSpritesFromTiles($spriteTiles, $spriteNames, $spriteGroup); | Loads a [spriteGroup](spriteGroup.md) from a GIF of tiles                  |
| renderImage(_$displayCoords_, _$fileName_, _$outputHeaders_); | Renders the entire isometric image                                         |
| detectCollision();                           || Detects for collisions between sprites.|
|                                              |                                                                            |
| **Reserved**                                 | The following are internal functions                                       |
| none                                         | none                                                                       |

#### loadSpriteFromImage($spriteImage, $x, $y, $z, $addToImage) ####
This function loads a [Sprite](Sprite.md) from an image file
| $spriteImage _(string)_ | The path of the image you wish to load. |
|:------------------------|:----------------------------------------|
| _$x_ _(int)_            | The X position to load the sprite at.   |
| _$y_ _(int)_            | The Y position to load the sprite at.   |
| _$z_ _(int)_            | The Z position to load the sprite at.   |
| _$addToImage_ _(bool)_  | Should the Sprite object be added to the output image |

#### loadSpriteFromCollection($spriteCollection) ####
This function loads a [Sprite](Sprite.md) from a [spriteCollection](spriteCollection.md)
| $spriteCollection | a [spriteCollection](spriteCollection.md) object |
|:------------------|:-------------------------------------------------|

#### loadSpriteFromGroup($spriteName, $spriteGroup) ####
This function loads a [Sprite](Sprite.md) from a [spriteGroup](spriteGroup.md).
| $spriteName _(string)_ | The name of the sprite to load |
|:-----------------------|:-------------------------------|
| $spriteGroup _(object)_ | The group of sprites to load it from |

#### loadSpriteFromObject($originalSprite) ####
This function copies a [Sprite](Sprite.md) and creates a new one based on it.
| $originalSprite _(object)_ | The original sprite object. |
|:---------------------------|:----------------------------|

#### loadSpritesFromTiles($spriteTiles, $spriteNames, $spriteGroup) ####
This function loads a [spriteGroup](spriteGroup.md) from one GIF file
| $spriteTiles | a GIF file containing all the sprites of equal widths, horizontaly. |
|:-------------|:--------------------------------------------------------------------|
| $spriteNames | The corrosponding names for each sprite (used in the group)         |
| $spriteGroup | An empty (or maybe not?) [spriteGroup](spriteGroup.md)              |

#### renderImage($displayCoords, $fileName) ####
This function renders the entire isometric image.
| _$displayCoords_ _(int)_ | Display the coords printed on the final image. |
|:-------------------------|:-----------------------------------------------|
|                          | -2 = no coords                                 |
|                          | -1 = all coords                                |
|                          | 0+ = coords for that Z height                  |
| _$fileName_ _(string)_   | Filename of the output file                    |
| _$outputHeaders_ _(bool)_ | Should we output headers? (Default: true)      |

#### createHTMLMap($imageFile) ####
Creates an image map (in HTML) for the current isometric image.
| _$imageFile_ _(string)_ | The name of the image file to map. |
|:------------------------|:-----------------------------------|

#### detectCollision() ####
This function detects for collisions between multiple sprites on a single tile, returns all the colliding sprites locations.

```







```
**Variables defined in this class:**
| blockWidth _(int)_ | This is the width (x) of the tiles/blocks (in pixels). |
|:-------------------|:-------------------------------------------------------|
| blockHeight _(int)_ | This is the height/2 (y) of the tiles/blocks (in pixels). |
| blockDepth _(int)_ | This is the depth (z) of the tiles/blocks (in pixels). |
| sprite _(mixed)_   | The list of loaded sprites.                            |
|                    |                                                        |
| **Reserved**       | The following are internal variables                   |
| outputImage _(mixed)_ | An internal var used to store the output image.        |
| loadedID _(array)_ | An internal var used to store all the loaded IDs.      |