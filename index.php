<?php
if(session_status()!=PHP_SESSION_ACTIVE) session_start();
?>
<!doctype html>
<html lang="ru">
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>LogIn/SignUp</title>

  <!-- STYLE CSS -->
  <!-- подключить библиотеку Bootstrap (css файл) -->
  <link rel="stylesheet" href="libs/bootstrap-4.0.0-dist/css/bootstrap.min.css">

  <link rel="stylesheet" type="text/css" href="css/style.css">

</head>
<body>
<?php
if ($_SESSION['nameUser'] != '') {
?>

<div class="container mt-5 authorized-user">
  <div >Привет, <?php echo $_SESSION['nameUser'];?>!</div>
  <a href="testPage.php">Другая страница</a>
  <button class=" goOut">Выйти</button>
</div>

<?php
}else{
?>

<div class="container mt-5 containerNavTab">
  <ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="logIn-tab" data-toggle="tab" href="#logIn" role="tab" aria-controls="logIn" aria-selected="true">Вход</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="signUp-tab" data-toggle="tab" href="#signUp" role="tab" aria-controls="signUp" aria-selected="false">Регистрация</a>
    </li>
  </ul>
  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="logIn" role="tabpanel" aria-labelledby="logIn-tab">
      <form class="mt-3 form-login">
        <div class="form-group">
          <label for="loginIn">Логин</label>
          <input type="text" class="form-control" id="loginIn" placeholder="Введите логин" name="loginIn">
          <small class="form-feedback"></small>
        </div>
        <div class="form-group">
          <label for="passwordIn">Пароль</label>
          <input type="password" class="form-control" id="passwordIn" placeholder="Введите пароль" name="passwordIn">
          <small class="form-feedback"></small>
        </div>
        <button type="submit" class="btn btn-primary btn-logIn">Войти</button>
      </form>
    </div>

    <div class="tab-pane fade" id="signUp" role="tabpanel" aria-labelledby="signUp-tab">
      <form class="mt-3 form-signup">
        <div class="form-group">
          <label for="name">Имя</label>
          <input type="text" class="form-control" id="name" placeholder="Введите имя"  name="name">
          <small class="form-control-feedback"></small>
        </div>
        <div class="form-group">
          <label for="login">Логин</label>
          <input type="text" class="form-control" id="login" placeholder="Введите логин"  name="login">
          <small class="form-control-feedback"></small>
        </div>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Введите email" name="email">
          <small class="form-control-feedback"></small>
        </div>
        <div class="form-group">
          <label for="password">Пароль</label>
          <input type="password" class="form-control" id="password" placeholder="Введите пароль"  name="password">
          <small class="form-control-feedback"></small>
        </div>
        <div class="form-group">
          <label for="confirmPassword">Повторите пароль</label>
          <input type="password" class="form-control" id="confirmPassword" placeholder="Введите пароль еще раз"  name="confirmPassword">
          <small class="form-control-feedback"></small>
        </div>
        <button type="submit" class="btn btn-primary btn-signUp">Зарегистрироваться</button>
      </form>
    </div>
  </div>
  
</div>

<?php  
}
?>

  <!-- библиотека jquery -->
  <!-- <script src="libs/jquery-3.6.0.min.js"></script> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

  <script type="text/javascript" src="js/javaScript.js"></script>

  <!-- подключить библиотеку Bootstrap (js файл) -->
  <script src="libs/bootstrap-4.0.0-dist/js/bootstrap.bundle.min.js"></script>
  <script src="libs/bootstrap-4.0.0-dist/js/bootstrap.min.js"></script>

</body>
</html>