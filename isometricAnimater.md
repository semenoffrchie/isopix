# isometricAnimater.class.php #
## Basic information ##
| **Class Name** | isometricAnimater |
|:---------------|:------------------|
| **File Name**  | isometricAnimater.class.php |
| **First Released** | 7th January 2007  |
| **Description** | isometricAnimater controls all animation |
| **Completed**  | 50%               |

## Class Demo ##
```
<?php
[..]
	$isometricAnimater->addFrame($isometricController);
	$tree->x = 3;
	$isometricAnimater->addFrame($isometricController);
	$isometricAnimater->renderImage();
[..]
?>
```

## Class documentation ##
**Functions defined in this class:**
| addFrame($isometricController) | Add a frame to the animation |
|:-------------------------------|:-----------------------------|
| renderImage($x, $y);           | Render the animation         |
|                                |                              |
| **Reserved**                   | The following are internal functions |
| none                           | none                         |

#### addFrame($isometricController) ####
This function adds a frame to the isometric animation
| $isometricController _(object)_ | The [isometricController](isometricController.md) object |
|:--------------------------------|:---------------------------------------------------------|

#### renderImage() ####
This function renders the animation to the screen

```







```
**Variables defined in this class:**
| none | none |
|:-----|:-----|
|      |      |
| **Reserved** | The following are internal variables |
| frames _(array)_ | The frames to be used in generation |