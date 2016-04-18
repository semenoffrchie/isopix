# spriteGroup.class.php #
## Basic information ##
| **Class Name** | spriteGroup |
|:---------------|:------------|
| **File Name**  | spriteGroup.class.php |
| **First Released** | 3rd January 2007 |
| **Description** | spriteGroup is a class that allows you to create a group of [Sprite](Sprite.md)s. |
| **Completed**  | 50%         |

## Class Demo ##
```
<?php
[...]
$slopeLeft = $isometricController->loadSpriteFromImage("sprites/slope-left.gif", 0, 0, 0, true);
$slopeRight = $isometricController->loadSpriteFromImage("sprites/slope-right.gif", 0, 0, 0, true);
$slope = new spriteGroup;
$slope->addSprite($slopeLeft, "left");
$slope->addSprite($slopeRight, "right");
$isometricController->loadSpriteFromGroup($slope, "left"); // Load the left slope image.
[...]
?>
```

## Class documentation ##
**Functions defined in this class:**
| addSprite($sprite, $name); | Adds a [Sprite](Sprite.md) to the group |
|:---------------------------|:----------------------------------------|
| repackSprites($function);  | Sorts the [Sprite](Sprite.md)s.         |
|                            |                                         |
| **Reserved**               | The following are internal functions    |
| none                       | none                                    |

#### addSprite($sprite, $name); ####
This function adds a [Sprite](Sprite.md) to the group of [Sprite](Sprite.md)s and allows you to reference it by its name.
| $sprite _(object)_ | The [Sprite](Sprite.md) object your wish to add. |
|:-------------------|:-------------------------------------------------|
| $name _(string)_   | The [Sprite](Sprite.md) name                     |

#### repackSprites($function) ####
This function sorts the sprites.
| $function _(string)_ | Prefix for the sort function used to pack the sprites. |
|:---------------------|:-------------------------------------------------------|

```







```
**Variables defined in this class:**
| none | none |
|:-----|:-----|
|      |      |
| **Reserved** | The following are internal variables |
| sprites _(array)_ | An internal var used to store the group sprites. |

#### sprites (array) ####
**This variable is reserved for internal use**

An internal var used to store the group sprites.