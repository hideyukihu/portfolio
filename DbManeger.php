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

function fetchALL() {
  $sql = "select * from do";
  $query = getDB()->query($sql);
  return $query->fetchALL(PDO::FETCH_ASSOC);
}

function create($text) {
  $now = date('Y/m/d H:i:s');
  $sql = "insert into todo.do (text, created_at, updated_at) values(?, ?, ?);";
  $stmt = getDB()->prepare($sql);
  $stmt->execute([$text, $now, $now]);
}

function update($id, $text)
{
    $sql = 'UPDATE todo SET text = ?, updated_at = ? WHERE do.id = ?';

    $stmt = getDB()->prepare($sql);

    $stmt->execute([$text, date('Y/m/d H:i:s'), $id]);
}

function delete($id)
{
    $sql = 'delete from do WHERE do.id = ?';
    $stmt = getdb()->prepare($sql);

    $stmt->execute([$id]);
}

