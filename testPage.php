<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
//require("app/functions.php");
?>
<!doctype html>
<html lang="ru">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>testPage</title>

  <!-- STYLE CSS -->
  <!-- подключить библиотеку Bootstrap (css файл) -->
  <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">


</head>
<body>
  <div class="container mt-5">
    <div>Это другая страница, <?php echo $_SESSION['nameUser']; ?>.</div>
    <div>Если хочешь вернуться на главную страницу, кликай <a href="index.php">сюда</a>.</div>
  </div>
</body>
</html>