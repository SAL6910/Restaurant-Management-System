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
																<strong>Tamanho máximo da imagem é 1024kb!</strong> Tente outra imagem.
															</div>';
      } else {
        $res_name = $_POST['res_name'];
        $sql = "update restaurant set c_id='$_POST[c_name]', title='$res_name',email='$_POST[email]',phone='$_POST[phone]',url='$_POST[url]',o_hr='$_POST[o_hr]',c_hr='$_POST[c_hr]',o_days='$_POST[o_days]',address='$_POST[address]',image='$fnew' where rs_id='$_GET[res_upd]' ";  // store the submited data into the database: images												mysqli_query($db, $sql); 
        mysqli_query($db, $sql);
        move_uploaded_file($temp, $store);
        $success =   '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>Registro Atualizado!</strong>.
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
																<strong>Extensão inválida!</strong> Apenas png, jpg, Gif são aceitos.
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
  <title>Atualizar Restaurante</title>
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
        <?php
        echo $error;
        echo $success;
        ?>
        <div class="col-lg-12">
          <div class="card card-outline-primary">
            <h4 class="m-b-0 ">Atualizar Restaurante</h4>
            <div class="card-body">
              <form action='' method='post' enctype="multipart/form-data">
                <div class="form-body">
                  <?php $ssql = "select * from restaurant where rs_id='$_GET[res_upd]'";
                  $res = mysqli_query($db, $ssql);
                  $row = mysqli_fetch_array($res); ?>
                  <hr>
                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Nome do Restaurante</label>
                        <input type="text" name="res_name" value="<?php echo $row['title'];  ?>" class="form-control" placeholder="Nome do Restaurante">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <label class="control-label">E-mail Comercial</label>
                        <input type="text" name="email" value="<?php echo $row['email'];  ?>" class="form-control form-control-danger" placeholder="example@gmail.com">
                      </div>
                    </div>

                  </div>

                  <div class="row p-t-20">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Telefone </label>
                        <input type="text" name="phone" class="form-control" value="<?php echo $row['phone'];  ?>" placeholder="1-(555)-555-5555">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <label class="control-label">URL do Site</label>
                        <input type="text" name="url" class="form-control form-control-danger" value="<?php echo $row['url'];  ?>" placeholder="http://exemplo.com">
                      </div>
                    </div>

                  </div>

                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Horário de Abertura</label>
                        <select name="o_hr" class="form-control custom-select" data-placeholder="Selecione o Horário">
                          <option>--Selecione o Horário--</option>
                          <option value="6am">6am</option>
                          <option value="7am">7am</option>
                          <option value="8am">8am</option>
                          <option value="9am">9am</option>
                          <option value="10am">10am</option>
                          <option value="11am">11am</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Horário de Fechamento</label>
                        <select name="c_hr" class="form-control custom-select" data-placeholder="Selecione o Horário">
                          <option>--Selecione o Horário--</option>
                          <option value="3pm">3pm</option>
                          <option value="4pm">4pm</option>
                          <option value="5pm">5pm</option>
                          <option value="6pm">6pm</option>
                          <option value="7pm">7pm</option>
                          <option value="8pm">8pm</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label class="control-label">Dias de Funcionamento</label>
                        <select name="o_days" class="form-control custom-select" data-placeholder="Selecione os Dias" tabindex="1">
                          <option>--Selecione os Dias--</option>
                          <option value="mon-tue">Seg-Ter</option>
                          <option value="mon-wed">Seg-Qua</option>
                          <option value="mon-thu">Seg-Qui</option>
                          <option value="mon-fri">Seg-Sex</option>
                          <option value="mon-sat">Seg-Sáb</option>
                          <option value="24hr-x7">24h x 7 dias</option>
                        </select>
                      </div>
                    </div>


                    <div class="col-md-6">
                      <div class="form-group has-danger">
                        <label class="control-label">Imagem</label>
                        <input type="file" name="file" id="lastName" class="form-control form-control-danger" placeholder="Imagem">
                      </div>
                    </div>


                    <div class="col-md-12">
                      <div class="form-group">
                        <label class="control-label">Selecione a Categoria</label>
                        <select name="c_name" class="form-control custom-select" data-placeholder="Escolha uma Categoria" tabindex="1">
                          <option>--Selecione a Categoria--</option>
                          <?php $ssql = "select * from res_category";
                          $res = mysqli_query($db, $ssql);
                          while ($rows = mysqli_fetch_array($res)) {
                            echo ' <option value="' . $rows['c_id'] . '">' . $rows['c_name'] . '</option>';;
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

                        <textarea name="address" type="text" style="height:100px;" class="form-control"> <?php echo $row['address']; ?> </textarea>
                      </div>
                    </div>
                  </div>
                </div>
            </div>
            <div class="form-actions">
              <input type="submit" name="submit" class="btn btn-success" value="Salvar">
              <a href="all_restaurant.php" class="btn btn-inverse">Cancelar</a>
            </div>
            </form>
          </div>
        </div>
      </div>
      <footer class="footer"> © 2024 Todos os direitos reservados.</footer>
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
