<?php
require_once 'globals.php';
require_once("connection/connect.php");

if (!IS_USER_LOGGED_IN) {
  header('location:login.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Falha na Operação | BaiaoFood</title>
  <link rel="icon" href="./icons/failure.png" type="image/png">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style type="text/css" rel="stylesheet">
    .failure-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
      background-color: #f8d7da;
      color: #721c24;
      padding: 20px;
    }

    .failure-icon {
      font-size: 60px;
      color: #dc3545;
      margin-bottom: 20px;
    }

    .failure-message {
      font-size: 24px;
      font-weight: bold;
    }

    .failure-details {
      font-size: 18px;
      margin: 10px 0;
    }

    .btn-back {
      background-color: #dc3545;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      text-decoration: none;
      margin-top: 20px;
    }

    .btn-back:hover {
      background-color: #c82333;
      color: white;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <?php require_once 'header.php'; ?>

  <div class="failure-container">
    <div class="failure-icon">
      <i class="fa fa-times-circle" aria-hidden="true"></i>
    </div>
    <div class="failure-message">Ops! Algo deu errado.</div>
    <div class="failure-details">
      A operação não pôde ser concluída. Verifique os detalhes e tente novamente.
    </div>
    <a href="index.php" class="btn-back">Voltar para a Página Inicial</a>
  </div>

  <?php require_once 'footer.php'; ?>

  <script src="js/jquery.min.js"></script>
  <script src="js/tether.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/animsition.min.js"></script>
  <script src="js/bootstrap-slider.min.js"></script>
  <script src="js/jquery.isotope.min.js"></script>
  <script src="js/headroom.js"></script>
  <script src="js/foodpicky.min.js"></script>
</body>

</html>
