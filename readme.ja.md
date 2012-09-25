MySQL CLI Client Querier

概要
====
MySQLのCLIクライアントを使いたい。でも直接DBサーバーにログインできない。

そんな時、このスクリプトがあればもう大丈夫。ルーティングさえ通っていれば、DBサーバー以外からコマンドラインの実行結果を取得できます。


必要環境
========
* PHP >= 5
* PEAR::Console_CommandLine

もしPEARライブラリがインストールされていない場合、下記コマンドでインストールできます。

    # pear install Console_CommandLine

使用方法
========
config.php を準備する
---------------------
1. config.php.sample を config.php にリネームします。
2. config.php にデータベースのDSN（接続先）とユーザーID、パスワードを入力します。

DSNの書き方がわからない場合、下記のサイトを参考にしてください。

[PHP: PDO::__construct - Manual](http://php.net/manual/pdo.construct.php)

標準的な使い方
--------------
    $ php query.php [options] <SQL>

ヘルプは *php query.php --help* で表示できます。

クエリ結果の取得方法
--------------------
結果の表示方法をオプションで選ぶことができます。

### print_r 形式
オプション未指定、または *-r print_r* オプションを付ける。

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

### var_dump 形式
*-r var_dump* オプションを付ける。

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

### MySQL テーブル形式
*-r table* オプションを付ける。

    # php query.php -r table "SELECT id, name FROM foo"
    +----+---------------+
    | ID |      NAME     |
    +----+---------------+
    | 1  | Miles Davis   |
    | 2  | John Coltrane |
    +----+---------------+
    total count: 2

このフォーマットには [Tony Landis](http://tonylandis.com/)氏の [PHP: Array to Text Table Generation Class — Gist](https://gist.github.com/31477) を利用させていただきました。ありがとうございます。


ライセンス
==========
[Open Source Initiative OSI - The MIT License (MIT):Licensing | Open Source Initiative](http://opensource.org/licenses/mit-license.php) に従います。
