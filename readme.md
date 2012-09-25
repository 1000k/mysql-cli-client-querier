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
    | ID |     NAME      |
    +----+---------------+
    | 1  | Miles Davis   |
    | 2  | John Coltrane |
    +----+---------------+
    total count: 2

This format is powered by [PHP: Array to Text Table Generation Class — Gist](https://gist.github.com/31477) by [Tony Landis](http://tonylandis.com/). Many thanks.


License
=======
This programs accordance with [Open Source Initiative OSI - The MIT License (MIT):Licensing | Open Source Initiative](http://opensource.org/licenses/mit-license.php).
