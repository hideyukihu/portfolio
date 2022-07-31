<?php
require_once './DbManeger.php';

$db = getDB();
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$stmt = $db->prepare("insert into todo.do(text, created_at, updated_at) values(:text, now(), now());");
if (!empty($_POST) && $_POST['text'] !== '') {
  $stmt->bindValue(':text', $_POST['text']);
  $stmt->execute();
}


if ($_SERVER['REQUEST_METHOD'] === "POST") {
  if (!empty($_POST['submit'])) {
    create($_POST['submit']);
  } else if (isset($_POST['update'])) {
    update($_POST['id'], $_POST['text']);
  } else if (isset($_POST['delete'])) {
    delete($_POST['id']);
  }
}

$DATA = fetchALL();
?>


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

  <section>
    <form method="post">
      <input type="text" name="submit" required>
      <button type="submit">作成する</button>
    </form>

    <table>
      <?php
      if ($DATA) {
      ?>
        <tr>
          <th  rowspan="2">
            TODO
          </th>
          <th bgcolor="#808080" rowspan="2">
            <font color="#FFFFFF">作成日</font>
          </th>
          <th bgcolor="#808080" colspan="2" id="action">
            <font color="#FFFFFF">操作</font>
          </th>
        </tr>
        <tr>
          <th bgcolor="#808080" headers="action">
            <font color="#FFFFFF">更新</font>
          </th>
          <th bgcolor="#808080" headers="action">
            <font color="#FFFFFF">削除</font>
          </th>
        </tr>
      <?php
      }
      ?>

      <?php foreach ((array)$DATA as $row) : ?>
        <form method="post">
          <tr>
            <input type="hidden" name="id" value="<?php echo $row["id"]; ?>">
            <td>
              <input type="text" name="text" value=<?php echo $row["text"]; ?> required>
            </td>
            <td>
              <?php echo $row["created_at"]; ?>
            </td>
            <td>
              <button type="submit" name="update">更新する</button>
            </td>
            <td>
              <button type="submit" name="delete">削除する</button>
            </td>
          </tr>
        </form>
      <?php endforeach; ?>



</body>

</html>

</html>