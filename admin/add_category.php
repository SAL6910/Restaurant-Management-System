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

    $check_cat = mysqli_query($db, "SELECT c_name FROM res_category where c_name = '" . $_POST['c_name'] . "' ");



    if (mysqli_num_rows($check_cat) > 0) {
      $error = '<div class="alert alert-danger alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																<strong>A categoria já existe!</strong>
															</div>';
    } else {


      $mql = "INSERT INTO res_category(c_name) VALUES('" . $_POST['c_name'] . "')";
      mysqli_query($db, $mql);
      $success =   '<div class="alert alert-success alert-dismissible fade show">
																<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
																Nova categoria adicionada com sucesso.</br></div>';
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
  <title>Adicionar Categoria</title>
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
        <div class="row">
          <div class="container-fluid">
            <?php
            echo $error;
            echo $success; ?>

            <div class="col-lg-12">
              <div class="card card-outline-primary">
                <div class="card-header">
                  <h4 class="m-b-0 text-white">Adicionar Categoria de Restaurante</h4>
                </div>
                <form action='' method='post'>
                  <div class="form-body">

                    <hr>
                    <div class="row p-t-20">
                      <div class="col-md-12">
                        <div class="form-group">
                          <label class="control-label">Categoria</label>
                          <input type="text" name="c_name" class="form-control">
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

        <div class="col-12">


          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Categorias Listadas</h4>

              <div class="table-responsive m-t-40">
                <table id="myTable" class="table table-bordered table-striped">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nome da Categoria</th>
                      <th>Data</th>

                      <th>Ação</th>

                    </tr>
                  </thead>
                  <tbody>


                    <?php
                    $sql = "SELECT * FROM res_category order by c_id desc";
                    $query = mysqli_query($db, $sql);

                    if (!mysqli_num_rows($query) > 0) {
                      echo '<td colspan="7"><center>Sem Dados de Categorias!</center></td>';
                    } else {
                      while ($rows = mysqli_fetch_array($query)) {



                        echo ' <tr><td>' . $rows['c_id'] . '</td>
																								<td>' . $rows['c_name'] . '</td>
																								<td>' . $rows['date'] . '</td>
																								
																									 <td><a href="delete_category.php?cat_del=' . $rows['c_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_category.php?cat_upd=' . $rows['c_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
																									</td></tr>';
                      }
                    }


                    ?>



                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>







      </div>

    </div>

      <?php require_once 'admin_footer.php'; ?>

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
