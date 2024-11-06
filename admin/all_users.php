<?php
include("../connection/connect.php");
error_reporting(0);
session_start();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Todos os Usuários</title>
  <link href="css/lib/bootstrap/bootstrap.min.css" rel="stylesheet">
  <link href="css/helper.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar">

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
          <div class="col-12">

            <div class="col-lg-12">
              <div class="card card-outline-primary">
                <div class="card-header">
                  <h4 class="m-b-0 text-white">Todos os Usuários</h4>
                </div>

                <div class="table-responsive m-t-40">
                  <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Nome de Usuário</th>
                        <th>Primeiro Nome</th>
                        <th>Sobrenome</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Endereço</th>
                        <th>Data de Registro</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>


                      <?php
                      $sql = "SELECT * FROM users order by u_id desc";
                      $query = mysqli_query($db, $sql);

                      if (!mysqli_num_rows($query) > 0) {
                        echo '<td colspan="7"><center>Sem Usuários</center></td>';
                      } else {
                        while ($rows = mysqli_fetch_array($query)) {



                          echo ' <tr><td>' . $rows['username'] . '</td>
																								<td>' . $rows['f_name'] . '</td>
																								<td>' . $rows['l_name'] . '</td>
																								<td>' . $rows['email'] . '</td>
																								<td>' . $rows['phone'] . '</td>
																								<td>' . $rows['address'] . '</td>																								
																								<td>' . $rows['date'] . '</td>
																									 <td><a href="delete_users.php?user_del=' . $rows['u_id'] . '" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a> 
																									 <a href="update_users.php?user_upd=' . $rows['u_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
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
    </div>
  </div>

  </div>
  <footer class="footer"> © 2024 Todos os direitos reservados.</footer>

  </div>

  </div>

  <script src="js/lib/jquery/jquery.min.js"></script>>
  <script src="js/lib/bootstrap/js/popper.min.js"></script>
  <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery.slimscroll.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <script src="js/custom.min.js"></script>


</body>

</html>
