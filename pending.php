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
  <title>Operação Pendente | BaiaoFood</title>
  <link rel="icon" href="./icons/pending.png" type="image/png">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style type="text/css" rel="stylesheet">
    .pending-container {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      height: 100vh;
      text-align: center;
      background-color: #fff3cd;
      color: #856404;
      padding: 20px;
    }

    .pending-icon {
      font-size: 60px;
      color: #ffc107;
      margin-bottom: 20px;
      animation: rotate 2s linear infinite;
    }

    @keyframes rotate {
      from {
        transform: rotate(0deg);
      }
      to {
        transform: rotate(360deg);
      }
    }

    .pending-message {
      font-size: 24px;
      font-weight: bold;
    }

    .pending-details {
      font-size: 18px;
      margin: 10px 0;
    }

    .btn-cancel {
      background-color: #ffc107;
      color: white;
      padding: 10px 20px;
      border: none;
      border-radius: 5px;
      font-size: 16px;
      text-decoration: none;
      margin-top: 20px;
    }

    .btn-cancel:hover {
      background-color: #e0a800;
      color: white;
      text-decoration: none;
    }
  </style>
</head>

<body>
  <?php require_once 'header.php'; ?>

  <div class="pending-container">
    <div class="pending-icon">
      <i class="fa fa-spinner" aria-hidden="true"></i>
    </div>
    <div class="pending-message">Por favor, aguarde...</div>
    <div class="pending-details">
      Sua solicitação está em processamento. Isso pode levar alguns segundos.
    </div>
    <a href="index.php" class="btn-cancel">Cancelar e Voltar para a Página Inicial</a>
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
