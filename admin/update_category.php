<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
  if (empty($_POST['c_name'])) {
    $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Campo obrigatório!</strong>
															</div>';
  } else {
    $mql = "update res_category set c_name ='$_POST[c_name]' where c_id='$_GET[cat_upd]'";
    mysqli_query($db, $mql);
    $success =   '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Atualizado!</strong> com sucesso.</br></div>';
  }
}


?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <title>Atualizar Categoria</title>
  <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/helper.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header">
  <div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
      <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10" />
    </svg>
  </div>
  <div id="main-wrapper">

      <?php require_once 'admin_header.php'; ?>
      <?php require_once 'left_sidebar.php'; ?>

    <div class="page-wrapper">
      <div class="row page-titles">
        <div class="col-md-5 align-self-center">
          <h3 class="text-primary">Painel de Controle</h3>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div class="container-fluid">
            <?php
            echo $error;
            echo $success; ?>
            <div class="col-lg-12">
              <div class="card card-outline-primary">
                <div class="card-header">
                  <h4 class="m-b-0 text-white">Atualizar Categoria de Restaurante</h4>
                </div>
                <div class="card-body">
                  <form action='' method='post'>
                    <div class="form-body">
                      <?php $ssql = "select * from res_category where c_id='$_GET[cat_upd]'";
                      $res = mysqli_query($db, $ssql);
                      $row = mysqli_fetch_array($res); ?>
                      <hr>
                      <div class="row p-t-20">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label class="control-label">Categoria</label>
                            <input type="text" name="c_name" value="<?php echo $row['c_name'];  ?>" class="form-control" placeholder="Nome da Categoria">
                          </div>
                        </div>


                      </div>
                      <div class="form-actions">
                        <input type="submit" name="submit" class="btn btn-success" value="Salvar">
                        <a href="add_category.php" class="btn btn-inverse">Cancelar</a>
                      </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <footer class="footer"> © 2024 Todos os direitos reservados. </footer>
    </div>
  </div>
  <script src="js/lib/jquery/jquery.min.js"></script>
  <script src="js/lib/bootstrap/js/popper.min.js"></script>
  <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery.slimscroll.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <script src="js/custom.min.js"></script>

</body>

</html>
