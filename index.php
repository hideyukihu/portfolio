<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>

<body>
  <form action="" method="POST">
    <div>
      <label for="text">text</label>
      <input type="text" id="text" name="text">
    </div>
    <div><input type="submit"></div>
  </form>
</body>

</html>

</html>


<?php
require_once './DbManeger.php';

$db = getDB();
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$stmt = $db->prepare("insert into todo.do(text, created_at, updated_at) values(:text, now(), now());");
if(!empty($_POST) && $_POST['text'] === '') {
  $stmt->bindValue(':text', $_POST['text']);
  $stmt->execute();
}

?>