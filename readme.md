MySQL CLI Client Querier

Abstract
========
Wanna use MySQL CLI Client... but I can't login to database server directly...

This script is useful in such situation. Even if the routing is set, you can get the result set from outside database server.


Requirement
===========
* PHP >= 5
* PEAR::Console_CommandLine

If PEAR library is not installed, type the following command and will be installed.

    # pear install Console_CommandLine


Usage
=====
Setting config.php
------------------
1. Rename 'config.php.sample' to 'config.php'.
2. Type your database's DSN, user ID and password in 'config.php'.

If you don't know how to write DSN, please refer the following site.

[PHP: PDO::__construct - Manual](http://php.net/manual/pdo.construct.php)

Basic Usage
-----------
    $ php query.php [options] <SQL>

Help message will show with *php query.php --help*.

Way To Get Result Set
---------------------
You can choose the format of result set with some options.

### print_r format
Without options or with *-r print_r* option.

    $ php query.php "SELECT id, name FROM foo"
    Array
    (
        [0] => Array
            (
                [id] => 1
                [name] => Miles Davis
            )

        [1] => Array
            (
                [id] => 2
                [name] => John Coltrane
            )

      )
    
    total count: 2

### var_dump format
With *-r var_dump*.

    # php query.php -r var_dump "SELECT id, name FROM foo"
    array(2) {
      [0]=>
      array(2) {
        ["id"]=>
        string(1) "1"
        ["name"]=>
        string(11) "Miles Davis"
      }
      [1]=>
      array(2) {
        ["id"]=>
        string(1) "2"
        ["name"]=>
        string(13) "John Coltrane"
      }
    }
    
    total count: 2

### MySQL table format
With *-r table*.

    # php query.php -r table "SELECT id, name FROM foo"
    +----+---------------+
    | ID |      NAME     |
    +----+---------------+
    | 1  | Miles Davis   |
    | 2  | John Coltrane |
    +----+---------------+
    total count: 2


License
=======
This programs accordance with [Open Source Initiative OSI - The MIT License (MIT):Licensing | Open Source Initiative](http://opensource.org/licenses/mit-license.php).

>The MIT License (MIT)
>
>Copyright (c) 2012 SENDA Keijiro
>
>Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
>
>The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
>
>THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
