# mvc
Implements a **simple MVC** Model View Controller in PHP
whith **user**, **post** and **send mail**.    
The user has registered before add __post__ or __send an mail__.

***
## Core
The **Core** is a simple *router* `domain.com/router/method/params`

* The first param is the name of **Controler**
* The second is the **method** to call
* the rest of params are arguments for the method.

~~~
     The uri http://www.domain.com/posts/edit/1    
     call posts->edit(1); on the Class Posts.php in Controller folder
~~~~
***
## Example
[Web example working](http://mvc.freecluster.eu/)

***

Enjoy!!

[mellambias@gmail.com](mailto:mellambias@gmail.com)
