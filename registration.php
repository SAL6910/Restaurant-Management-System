<?php

require_once 'connection/connect.php';
require_once 'globals.php';

if (isset($_POST['submit'])) {
    if (
        empty($_POST['firstname']) ||
        empty($_POST['lastname']) ||
        empty($_POST['email']) ||
        empty($_POST['phone']) ||
        empty($_POST['password']) ||
        empty($_POST['cpassword'])
    ) {
        $message = "Todos os campos são obrigatórios!";
    } else {
        $stmt_username = $db->prepare("SELECT username FROM users WHERE username = ?");
        $stmt_username->bind_param("s", $_POST['username']);
        $stmt_username->execute();
        $check_username = $stmt_username->get_result();

        $stmt_email = $db->prepare("SELECT email FROM users WHERE email = ?");
        $stmt_email->bind_param("s", $_POST['email']);
        $stmt_email->execute();
        $check_email = $stmt_email->get_result();

        if ($_POST['password'] != $_POST['cpassword']) {
            echo "<script>alert('As senhas não coincidem');</script>";
        } elseif (strlen($_POST['password']) < 6) {
            echo "<script>alert('A senha deve ter no mínimo 6 caracteres');</script>";
        } elseif (strlen($_POST['phone']) < 10) {
            echo "<script>alert('Número de telefone inválido!');</script>";
        } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            echo "<script>alert('Endereço de email inválido, por favor digite um email válido!');</script>";
        } elseif ($check_username->num_rows > 0) {
            echo "<script>alert('Nome de usuário já existe!');</script>";
        } elseif ($check_email->num_rows > 0) {
            echo "<script>alert('O email já está registrado!');</script>";
        } else {
            $stmt_insert = $db->prepare("INSERT INTO users (username, f_name, l_name, email, phone, password, address) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $password_hash = md5($_POST['password']); 
            $stmt_insert->bind_param(
                "sssssss",
                $_POST['username'],
                $_POST['firstname'],
                $_POST['lastname'],
                $_POST['email'],
                $_POST['phone'],
                $password_hash,
                $_POST['address']
            );
            $stmt_insert->execute();

            echo "<script>alert('Cadastro realizado com sucesso!');</script>";
            header("refresh:0.1;url=login.php");
            exit();
        }

        $stmt_username->close();
        $stmt_email->close();
        $stmt_insert->close();
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="#">
  <title>Registration</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <div style=" background-image: url('images/img/background_login.jpg');">

    <?php require_once 'header.php'; ?>

    <div class="page-wrapper">

      <div class="container">
        <ul>
        </ul>
      </div>

      <section class="contact-page inner-page">
        <div class="container">
          <div class="row">
            <div class="col-md-8">
              <div class="widget">
                <div class="widget-body">

                  <form action="" method="post">
                    <div class="row">
                      <div class="form-group col-sm-12">
                        <label for="exampleInputEmail1">Nome de Usuário</label>
                        <input class="form-control" type="text" name="username" id="example-text-input">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Primeiro Nome</label>
                        <input class="form-control" type="text" name="firstname" id="example-text-input">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Sobrenome</label>
                        <input class="form-control" type="text" name="lastname" id="example-text-input-2">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Endereço de Email</label>
                        <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="exampleInputEmail1">Número de Telefone</label>
                        <input class="form-control" type="text" name="phone" id="example-tel-input-3">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Senha</label>
                        <input type="password" class="form-control" name="password" id="exampleInputPassword1">
                      </div>
                      <div class="form-group col-sm-6">
                        <label for="exampleInputPassword1">Confirmar Senha</label>
                        <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2">
                      </div>
                      <div class="form-group col-sm-12">
                        <label for="exampleTextarea">Endereço de Entrega</label>
                        <textarea class="form-control" id="exampleTextarea" name="address" rows="3"></textarea>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-sm-4">
                        <p> <input type="submit" value="Registrar" name="submit" class="btn theme-btn"> </p>
                      </div>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <?php require_once 'footer.php'; ?>

    </div>

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
