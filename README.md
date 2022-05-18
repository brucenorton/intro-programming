# intro-programming
lots of code exammples

Here's a link to [the working demo](https://web582.com/programming/sehli_todo/).

in [/php/todo-toggle.php](/sehli_todo/php/todo-toggle.php) the problem was I was passing an object, not the value of that object.

This is the correct line to pass the value:

markCompleted($resultArray[0]["completed"]);
