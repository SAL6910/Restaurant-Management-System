<?php
include("../connection/connect.php");
error_reporting(0);
session_start();

if (!empty($_SESSION["adm_id"])) {
  header('location: dashboard.php');
  exit();
}

if (isset($_POST['submit'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if (!empty($_POST["submit"])) {
    $loginquery = "SELECT * FROM admin WHERE username='$username' && password='" . md5($password) . "'";
    $result = mysqli_query($db, $loginquery);
    $row = mysqli_fetch_array($result);

    if (is_array($row)) {
      $_SESSION["adm_id"] = $row['adm_id'];
      header("refresh:1;url=dashboard.php");
    } else {
      echo "<script>alert('Usuário ou senha inválidos!');</script>";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <title>Login do Administrador</title>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">

  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700,900'>
  <link rel='stylesheet prefetch' href='https://fonts.googleapis.com/css?family=Montserrat:400,700'>
  <link rel='stylesheet prefetch' href='https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css'>

  <link rel="stylesheet" href="css/login.css">


</head>

<body>


  <div class="container">
    <div class="info">
      <h1>Painel de Administração</h1>
    </div>
  </div>
  <div class="form">
    <div class="thumbnail"><img src="images/manager.png" /></div>
    <span style="color:red;"><?php echo $message; ?></span>
    <span style="color:green;"><?php echo $success; ?></span>
    <form class="login-form" action="index.php" method="post">
      <input type="text" placeholder="Nome de Usuário" name="username" />
      <input type="password" placeholder="Senha" name="password" />
      <input type="submit" name="submit" value="Entrar" />

    </form>

  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src='js/index.js'></script>
</body>

</html>
