# heightMap.class.php #
## Basic information ##
| **Class Name** | heightMap |
|:---------------|:----------|
| **File Name**  | heightMap.class.php |
| **First Released** | 4th January 2007 |
| **Description** | heightMap controls all height map activity |
| **Completed**  | 50%       |

## Class Demo ##
```
<?php
$heightMap = new heightMap;
$l1 = array("left", 1);
$l0 = array("left", 0);
$myMap = array();
$myMap[] = array(  2,   2,   2,   2,   2,   2,   2, $l1, $l1, $l0);
$myMap[] = array(  2,   2,   2,   2,   2, $l1, $l1, $l0, $l0);
$myMap[] = array(  2,   2,   2, $l1, $l1, $l0, $l0);
$myMap[] = array(  2, $l1, $l1, $l0, $l0);
$myMap[] = array($l1, $l0, $l0);
$myMap[] = array($l0);
$heightMap->setHeightMap($myMap);
$heightMap = $heightMap->renderMap(new spriteCollection, $backgroundSprite, $slopeGroup);
?>
```

## Class documentation ##
**Functions defined in this class:**
| setMapHeight($z) | Set the default Z height |
|:-----------------|:-------------------------|
| setMapSize($x, $y); | Set the map width/height |
| setHeightMap($heightMap); | Set the heightMap map    |
| renderMap($spriteCollection, $backgroundSprite, $slopeSprite); | Render the heightMap     |
|                  |                          |
| **Reserved**     | The following are internal functions |
| none             | none                     |

#### setMapHeight($z) ####
This function sets the default Z height for the [heightMap](heightMap.md)
| $z _(int)_ | The new default Z height |
|:-----------|:-------------------------|

#### setMapSize($x, $y) ####
This function sets the map width/height.
| $x _(int)_ | The new width |
|:-----------|:--------------|
| $y _(int)_ | The new height |

#### setHeightMap($heightMap) ####
This function sets the [heightMap](heightMap.md) data.
See the class demo for sample data.
| $heightMap _(array)_ | See above (demo) for the data syntax |
|:---------------------|:-------------------------------------|

#### renderMap($spriteCollection, $backgroundSprite, $slopeSprite) ####
This function renders the height map and returns a [spriteCollection](spriteCollection.md) containing all the sprites that need to be applied
to the final image, this function does not apply them to the image.
| $spriteCollection _(object)_ | This is a [spriteCollection](spriteCollection.md), doesn't need to be empty, but would be prefered |
|:-----------------------------|:---------------------------------------------------------------------------------------------------|
| $backgroundSprite _(object)_ | The object of the [Sprite](Sprite.md) that should be used as the background                        |
| $slopeSprite _(object)_      | A [spriteGroup](spriteGroup.md), containing pictures for every angle of the slopes                 |

```







```
**Variables defined in this class:**
| none | none |
|:-----|:-----|
|      |      |
| **Reserved** | The following are internal variables |
| x _(int)_ | The width of the [heightMap](heightMap.md) |
| y _(int)_ | The height of the [heightMap](heightMap.md) |
| z _(int)_ | The Z-height of the [heightMap](heightMap.md) |
| heightMap _(array)_ | An internal var used to store the [heightMap](heightMap.md) |