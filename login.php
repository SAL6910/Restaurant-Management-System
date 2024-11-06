<?php
require_once 'globals.php';
require_once 'connection/connect.php';

if (IS_USER_LOGGED_IN) {
  header("refresh:1;url=index.php");
  exit();
}

$success = '';
$message = '';


if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($_POST["submit"])) {
    $loginquery = "SELECT * FROM users WHERE username='$username' && password='" . md5($password) . "'"; //selecting matching records
    $result = mysqli_query($db, $loginquery); //executing
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      $_SESSION["user_id"] = $row['u_id'];
      header("refresh:1;url=index.php");
      exit();
    } else {
      $message = "Nome de Usuário ou Senha inválidos";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900|RobotoDraft:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/login.css">

  <style type="text/css">
    #buttn {
      color: #fff;
      background-color: #ff3300;
    }
  </style>


  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">

</head>

<body>

  <?php require_once 'header.php'; ?>

  <div style=" background-image: url('images/img/background_login.jpg');">

    <div class="pen-title">
    </div>

    <div class="module form-module">
      <div class="toggle">

      </div>
      <div class="form">
        <h2>Faça login na sua conta</h2>
        <span style="color:red;"><?php echo $message; ?></span>
        <span style="color:green;"><?php echo $success; ?></span>
        <form action="" method="post">
          <input type="text" placeholder="Nome de usuário" name="username" />
          <input type="password" placeholder="Senha" name="password" />
          <input type="submit" id="buttn" name="submit" value="Login" />
        </form>
      </div>

      <div class="cta">Não registrado?<a href="registration.php" style="color:#f30;"> Crie uma conta</a></div>
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>

    <div class="container-fluid pt-3">
      <p></p>
    </div>

    <?php require_once 'footer.php'; ?>

</body>

</html>
