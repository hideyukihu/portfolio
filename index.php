<?php  

$dsn = 'mysql:dbname=test_phpdb; port=8889; host=localhost; charset=utf8';
$usr = 'root';
$passwd = 'root';

try {
  $db = new PDO($dsn, $usr, $passwd);
  print '接続に成功しました';
  $db->setAttribute(pdo::ATTR_DEFAULT_FETCH_MODE, pdo::FETCH_ASSOC);
  $pst = $db->query('update mst_prefs set name = "新潟" where id = 5');
  $result = $pst->fetchAll();
  echo '<pre>';
  var_dump($result);
  echo '</pre>';
} catch (PDOException $e){
  die("接続エラー：{$e->getMessage()}");
} finally {
}

print_r(PDO::FETCH_ASSOC);



