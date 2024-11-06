<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
if (isset($_POST['submit'])) {
  if (empty($_POST['c_name']) || empty($_POST['res_name']) || $_POST['email'] == '' || $_POST['phone'] == '' || $_POST['url'] == '' || $_POST['o_hr'] == '' || $_POST['c_hr'] == '' || $_POST['o_days'] == '' || $_POST['address'] == '') {
    $error =   '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Todos os campos devem ser preenchidos!</strong>
															</div>';
  } else {
    $fname = $_FILES['file']['name'];
    $temp = $_FILES['file']['tmp_name'];
    $fsize = $_FILES['file']['size'];
    $extension = explode('.', $fname);
    $extension = strtolower(end($extension));
    $fnew = uniqid() . '.' . $extension;
    $store = "Res_img/" . basename($fnew);
    if ($extension == 'jpg' || $extension == 'png' || $extension == 'gif') {
      if ($fsize >= 1000000) {
        $error =   '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>O tamanho máximo da imagem é 1024kb!</strong> Tente outra imagem.
															</div>';
      } else {
        $res_name = $_POST['res_name'];
        $sql = "INSERT INTO restaurant(c_id,title,email,phone,url,o_hr,c_hr,o_days,address,image) VALUE('" . $_POST['c_name'] . "','" . $res_name . "','" . $_POST['email'] . "','" . $_POST['phone'] . "','" . $_POST['url'] . "','" . $_POST['o_hr'] . "','" . $_POST['c_hr'] . "','" . $_POST['o_days'] . "','" . $_POST['address'] . "','" . $fnew . "')";  // armazenar os dados enviados no banco de dados: imagens
        mysqli_query($db, $sql);
        move_uploaded_file($temp, $store);
        $success =   '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																 Novo restaurante adicionado com sucesso.
															</div>';
      }
    } elseif ($extension == '') {
      $error =   '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Selecione uma imagem</strong>
															</div>';
    } else {

      $error =   '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Extensão inválida!</strong> Apenas png, jpg e gif são aceitos.
															</div>';
    }
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
  <title>Adicionar Restaurante</title>
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
      <div class="container-fluid">

        <?php
        echo $error;
        echo $success;
        ?>
        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <div class="card-header">
              <h4 class="m-b-0 text-white">Adicionar Restaurante</h4>
            </div>
            <div class="card-body">
              <form action='' method='post' enctype="multipart/form-data">
                <div class="form-body">
                  <hr>
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Nome do Restaurante</label>
                        <input type="text" name="res_name" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <label class="control-label">E-mail Comercial</label>
                        <input type="text" name="email" class="form-control form-control-danger">
                      </div>
                    </div>
                  </div>
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Telefone </label>
                        <input type="text" name="phone" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <label class="control-label">URL do Website</label>
                        <input type="text" name="url" class="form-control form-control-danger">
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Horário de Abertura</label>
                        <select name="o_hr" class="form-control custom-select" data-placeholder="Escolha um Horário">
                          <option>--Selecione o Horário--</option>
                          <option value="6am">6am</option>
                          <option value="7am">7am</option>
                          <option value="8am">8am</option>
                          <option value="9am">9am</option>
                          <option value="10am">10am</option>
                          <option value="11am">11am</option>
                          <option value="12pm">12pm</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Horário de Fechamento</label>
                        <select name="c_hr" class="form-control custom-select" data-placeholder="Escolha um Horário">
                          <option>--Selecione o Horário--</option>
                          <option value="3pm">3pm</option>
                          <option value="4pm">4pm</option>
                          <option value="5pm">5pm</option>
                          <option value="6pm">6pm</option>
                          <option value="7pm">7pm</option>
                          <option value="8pm">8pm</option>
                          <option value="9pm">9pm</option>
                          <option value="10pm">10pm</option>
                          <option value="11pm">11pm</option>
                          <option value="12am">12am</option>
                          <option value="1am">1am</option>
                          <option value="2am">2am</option>
                          <option value="3am">3am</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Dias de Funcionamento</label>
                        <select name="o_days" class="form-control custom-select" data-placeholder="Escolha um Período" tabindex="1">
                          <option>--Selecione os Dias--</option>
                          <option value="Mon-Tue">Seg-Ter</option>
                          <option value="Mon-Wed">Seg-Qua</option>
                          <option value="Mon-Thu">Seg-Qui</option>
                          <option value="Mon-Fri">Seg-Sex</option>
                          <option value="Mon-Sat">Seg-Sáb</option>
                          <option value="24hr-x7">24hrs-x7</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <label class="control-label">Imagem</label>
                        <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="12n">
                      </div>
                    </div>
                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Selecione a Categoria</label>
                        <select name="c_name" class="form-control custom-select" data-placeholder="Escolha uma Categoria" tabindex="1">
                          <option>--Selecione a Categoria--</option>
                          <?php
                          $ssql = "select * from res_category";
                          $res = mysqli_query($db, $ssql);
                          while ($row = mysqli_fetch_array($res)) {
                            echo ' <option value="' . $row['c_id'] . '">' . $row['c_name'] . '</option>';;
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <h3 class="box-title m-t-40">Endereço do Restaurante</h3>
                  <hr>
                  <div class="row">
                    <div class="col-md-12 ">
                      <div class="form-group">
                        <textarea name="address" type="text" style="height:100px;" class="form-control"></textarea>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-actions">
              <input type="submit" name="submit" class="btn btn-success" value="Salvar">
              <a href="add_restaurant.php" class="btn btn-inverse">Cancelar</a>
            </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer"> © 2024 Todos os direitos reservados. </footer>
    </div>
  </div>
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
