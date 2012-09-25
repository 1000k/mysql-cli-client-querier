<?php
/**
 * MySQL CLI Client Querier
 *
 * @copyright     (c) 2012 SENDA Keijiro
 * @link          http://1000k.5qk.jp
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

require_once 'config.php';
require_once 'Console/CommandLine.php';
require_once 'ArrayToTextTable.php';

$parser = new Console_CommandLine();
$parser->description = 'A command line program to avoid going to L3 area.';
$parser->addArgument('query', array(
  'description' => 'SQL query',
  'help_name' => 'SQL',
));
$parser->addOption('render', array(
  'description' => 'rendering method (default print_r)',
  'help_name' => 'method',
  'short_name' => '-r',
  'long_name' => '--render',
  'default' => 'print_r',
  'choices' => array('print_r', 'var_dump', 'table'),
));

try {
  $parsed = $parser->parse();

  $dsn = DB_DSN;
  $user = DB_USER;
  $password = DB_PASSWORD;

  $pdo = new PDO($dsn, $user, $password);

  $stmt = $pdo->query($parsed->args['query']);
  if ($stmt) {
    $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

    switch ($parsed->options['render']) {
      case 'var_dump':
        var_dump($data);
        break;
      case 'table':
        $renderer = new ArrayToTextTable($data);
        $renderer->showHeaders(true);
        $renderer->render();
        break;
      case 'print_r':
      default:
        print_r($data);
        break;
    }

    echo "\ntotal count: " . count($data) . "\n";
  } else {
    $info = $pdo->errorInfo();

    echo 'SQLSTATE error code ... ' . $info[0] . "\n";
    echo isset($info[1]) ? 'Driver-epecific error code ... ' . $info[1] . "\n" : null;
    echo isset($info[2]) ? 'Driver-epecific error message ... ' . $info[2] . "\n" : null;
  }
} catch (Exception $e) {
  $parser->displayError($e->getMessage());
} catch (PDOException $e) {
  echo $e->getMessage();
}
