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
  <link rel="icon" type="image/png" sizes="16x16" href="images/favicon.png">
  <title>Todos os Pedidos</title>
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
                  <h4 class="m-b-0 text-white">Todos os Pedidos</h4>
                </div>
                <div class="table-responsive m-t-40">
                  <table id="myTable" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Usuário</th>
                        <th>Título</th>
                        <th>Quantidade</th>
                        <th>Preço</th>
                        <th>Endereço</th>
                        <th>Status</th>
                        <th>Data de Registro</th>
                        <th>Ação</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $sql = "SELECT users.*, users_orders.* FROM users INNER JOIN users_orders ON users.u_id=users_orders.u_id ";
                      $query = mysqli_query($db, $sql);

                      if (!mysqli_num_rows($query) > 0) {
                        echo '<td colspan="8"><center>Sem Pedidos</center></td>';
                      } else {
                        while ($rows = mysqli_fetch_array($query)) {

                      ?>
                          <?php
                          echo ' <tr>
																					           <td>' . $rows['username'] . '</td>
																								<td>' . $rows['title'] . '</td>
																								<td>' . $rows['quantity'] . '</td>
																								<td>R$' . $rows['price'] . '</td>
																								<td>' . $rows['address'] . '</td>';
                          ?>
                          <?php
                          $status = $rows['status'];
                          if ($status == "" or $status == "NULL") {
                          ?>
                            <td> <button type="button" class="btn btn-info" style="font-weight:bold;"><span class="fa fa-bars" aria-hidden="true"> Despachar</button></td>
                          <?php
                          }
                          if ($status == "in process") { ?>
                            <td> <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> A Caminho!</button></td>
                          <?php
                          }
                          if ($status == "closed") {
                          ?>
                            <td> <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"> Entregue</button></td>
                          <?php
                          }
                          ?>
                          <?php
                          if ($status == "rejected") {
                          ?>
                            <td> <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelado</button></td>
                          <?php
                          }
                          ?>
                          <?php
                          echo '	<td>' . $rows['date'] . '</td>';
                          ?>
                          <td>
                            <a href="delete_orders.php?order_del=<?php echo $rows['o_id']; ?>" onclick="return confirm(\'Você tem certeza?\');" class="btn btn-danger btn-flat btn-addon btn-xs m-b-10"><i class="fa fa-trash-o" style="font-size:16px"></i></a>
                        <?php
                          echo '<a href="view_order.php?user_upd=' . $rows['o_id'] . '" " class="btn btn-info btn-flat btn-addon btn-sm m-b-10 m-l-5"><i class="ti-settings"></i></a>
																									</td>
																									</tr>';
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
  <script src="js/lib/jquery/jquery.min.js"></script>
  <script src="js/lib/bootstrap/js/popper.min.js"></script>
  <script src="js/lib/bootstrap/js/bootstrap.min.js"></script>
  <script src="js/jquery.slimscroll.js"></script>
  <script src="js/sidebarmenu.js"></script>
  <script src="js/lib/sticky-kit-master/dist/sticky-kit.min.js"></script>
  <script src="js/custom.min.js"></script>
  <script src="js/lib/datatables/datatables.min.js"></script>
  <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
  <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
  <script src="js/lib/datatables/cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
  <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
  <script src="js/lib/datatables/cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
  <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
  <script src="js/lib/datatables/cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>

</body>

</html>
