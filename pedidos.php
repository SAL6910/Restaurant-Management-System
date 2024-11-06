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
  <title>Pedidos | BaiaoFood</title>
  <link rel="icon" href="./icons/request.png" type="image/png">
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
  <style type="text/css" rel="stylesheet">
    .page-wrapper {
      padding-top: 20px;
    }

    .restaurant-entry {
      background-color: #f9f9f9;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 20px;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin: auto;
      background-color: #fff;
      border-radius: 8px;
      overflow: hidden;
    }

    th {
      background-color: #ff6600;
      color: #fff;
      font-weight: bold;
      padding: 12px;
      text-align: left;
    }

    td {
      padding: 10px;
      border-bottom: 1px solid #eee;
      font-size: 14px;
    }

    tr:nth-of-type(odd) {
      background-color: #f7f7f7;
    }

    tr:last-child td {
      border-bottom: none;
    }

    button.btn {
      font-size: 14px;
      padding: 6px 10px;
    }

    .btn-danger {
      background-color: #dc3545;
      color: #fff;
      border: none;
    }

    .btn-info {
      background-color: #17a2b8;
      color: #fff;
      border: none;
    }

    .btn-warning {
      background-color: #ffc107;
      color: #fff;
      border: none;
    }

    .btn-success {
      background-color: #28a745;
      color: #fff;
      border: none;
    }

    .btn:hover {
      opacity: 0.9;
    }
  </style>
</head>

<body>
  <?php require_once 'header.php'; ?>
  <div class="page-wrapper">
    <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
      <div class="container"> </div>
    </div>

    <section class="restaurants-page">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-8 offset-md-2">
            <div class="bg-gray restaurant-entry">
              <div class="row">
                <table>
                  <thead>
                    <tr>
                      <th>Item</th>
                      <th>Quantidade</th>
                      <th>Preço (R$)</th>
                      <th>Status</th>
                      <th>Data</th>
                      <th>Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $query_res = mysqli_query($db, "select * from users_orders where u_id='" . $_SESSION['user_id'] . "'");
                    if (!mysqli_num_rows($query_res) > 0) :
                      echo '<tr><td colspan="6" style="text-align:center;">Você ainda não fez nenhum pedido.</td></tr>';
                    else :
                      while ($row = mysqli_fetch_array($query_res)) :
                    ?>
                        <tr>
                          <td data-column="Item"> <?php echo $row['title']; ?></td>
                          <td data-column="Quantidade"> <?php echo $row['quantity']; ?></td>
                          <td data-column="Preço (R$)">R$<?php echo number_format($row['price'], 2, ',', '.'); ?></td>
                          <td data-column="Status">
                            <?php
                            $status = $row['status'];
                            if ($status == "" or $status == "NULL") :
                            ?>
                              <button type="button" class="btn btn-info"><span class="fa fa-bars" aria-hidden="true"></span> Envio</button>
                            <?php elseif ($status == "in process") : ?>
                              <button type="button" class="btn btn-warning"><span class="fa fa-cog fa-spin" aria-hidden="true"></span> A Caminho!</button>
                            <?php elseif ($status == "closed") : ?>
                              <button type="button" class="btn btn-success"><span class="fa fa-check-circle" aria-hidden="true"></span> Entregue</button>
                            <?php elseif ($status == "rejected") : ?>
                              <button type="button" class="btn btn-danger"> <i class="fa fa-close"></i> Cancelado</button>
                            <?php endif; ?>
                          </td>
                          <td data-column="Data"> <?php echo date("d/m/Y", strtotime($row['date'])); ?></td>
                          <td data-column="Ação">
                            <a href="delete_orders.php?order_del=<?php echo $row['o_id']; ?>" onclick="return confirm('Tem certeza de que deseja cancelar seu pedido?');" class="btn btn-danger btn-xs">
                              <i class="fa fa-trash-o" style="font-size:16px"></i>
                            </a>
                          </td>
                        </tr>
                    <?php
                      endwhile;
                    endif; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

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
