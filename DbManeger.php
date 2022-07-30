<?php  
function getDB()
{
  $dsn = 'mysql:dbname=todo; port=8889; host=localhost; charset=utf8';
  $usr = 'root';
  $passwd = 'root';

  try {
    $db = new PDO($dsn, $usr, $passwd);
    print '接続に成功しました';
    return $db;
  } catch (PDOException $e) {
    die("接続エラー：{$e->getMessage()}");
  } finally {
  }
}
