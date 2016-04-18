# displayCode.class.php #
## Basic information ##
| **Class Name** | displayCode |
|:---------------|:------------|
| **File Name**  | displayCode.class.php |
| **First Released** | 1st January 2007 |
| **Description** | displayCode is a simple class that displays PHP syntax highlighted code, used for development and debugging purposes. |
| **Completed**  | 37%         |

## Class documentation ##
**Functions defined in this class:**
| displayCode($file); | used as the constructor function |
|:--------------------|:---------------------------------|

#### displayCode($file) ####
This function is the only function defined in displayCode.class.php, it is the main function (called as a constructor).
This function basicly takes _$file_ and highlights it using PHP syntax highlight and adds line numbers, then it proceeds to output the code to the output buffer.
| $file _(string)_ | The path to the file that needs to be highlighted. |
|:-----------------|:---------------------------------------------------|
|                  | **Returns nothing**                                |