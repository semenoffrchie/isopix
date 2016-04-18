# spriteCollection.class.php #
## Basic information ##
| **Class Name** | spriteCollection |
|:---------------|:-----------------|
| **File Name**  | spriteCollection.class.php |
| **First Released** | 3rd January 2007 |
| **Description** | spriteCollection is a class that allows you to put alot of sprites all under the same object, and then add them all at once. |
| **Completed**  | 50%              |

## Class Demo ##
```
<?php
[...]
$slopeSprite = $isometricController->loadSpriteFromImage("sprites/slope.gif", 0, 0, 0, true);
$slope = new spriteCollection;
$slope->addSprite($slopeSprite, array(0, 10, 0), array(-1, 11, 0), array(0, 10, 0));
$isometricController->loadSpriteFromCollection($slope);
[...]
?>
```

## Class documentation ##
**Functions defined in this class:**
| addSprite($collectionSprite, arrays of x,y,z coord); | Adds a [Sprite](Sprite.md) to the collection |
|:-----------------------------------------------------|:---------------------------------------------|
|                                                      |                                              |
| **Reserved**                                         | The following are internal functions         |
| none                                                 | none                                         |

#### addSprite($collectionSprite, arrays of x,y,z coord); ####
This function adds a [Sprite](Sprite.md) to the collection, you can supply an unlimited amount of arrays of (x,y,z) and the sprite will be placed at every (x,y,z) location supplied.
| $collectionSprite _(object)_ | The [Sprite](Sprite.md) object your wish to add. |
|:-----------------------------|:-------------------------------------------------|
| arrays of x,y,z coord _(arrays)_ | Arrays of (x,y,z) positions.                     |

```







```
**Variables defined in this class:**
| none | none |
|:-----|:-----|
|      |      |
| **Reserved** | The following are internal variables |
| sprites _(array)_ | An internal var used to store the collection sprites. |

#### sprites (array) ####
**This variable is reserved for internal use**

An internal var used to store the collection sprites.