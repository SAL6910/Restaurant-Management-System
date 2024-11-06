<?php
require_once 'connection/connect.php';
require_once 'product-action.php';
require_once 'globals.php';
require 'vendor/autoload.php';

MercadoPago\SDK::setAccessToken('APP_USR-858640062735956-110211-a4bc6d2eed69b35ec17f1057bb57c93e-50169775');

if (!IS_USER_LOGGED_IN) {
  header('location:login.php');
  exit();
}

if (!isset($_SESSION['cart_item']) || empty($_SESSION['cart_item'])) {
  header('location:restaurants.php');
  exit();
}

$success = '';
$item_total = 0;

// Calcula o total do carrinho antes de processar o pedido
foreach ($_SESSION["cart_item"] as $item) {
  $item_total += ($item["price"] * $item["quantity"]);
}

if ($_POST['submit'] ?? null) {
  // Criação de uma nova preferência de pagamento
  $preference = new MercadoPago\Preference();

  $items = [];
  foreach ($_SESSION["cart_item"] as $item) {
    // Configuração dos itens da preferência
    $mp_item = new MercadoPago\Item();
    $mp_item->title = $item["title"];
    $mp_item->quantity = $item["quantity"];
    $mp_item->currency_id = "BRL";
    $mp_item->unit_price = $item["price"];
    $items[] = $mp_item;

    // Salvando o pedido no banco
    $SQL = "INSERT INTO users_orders(u_id, title, quantity, price) VALUES('" . $_SESSION["user_id"] . "', '" . $item["title"] . "', '" . $item["quantity"] . "', '" . $item["price"] . "')";
    mysqli_query($db, $SQL);
  }

  // Adicionando itens à preferência
  $preference->items = $items;

  // URL de redirecionamento após o pagamento
  $preference->back_urls = array(
    "success" => "https://lightskyblue-owl-392240.hostingersite.com/pedidos.php",
    "failure" => "https://lightskyblue-owl-392240.hostingersite.com/failure.php",
    "pending" => "https://lightskyblue-owl-392240.hostingersite.com/pending.php"
  );
  $preference->auto_return = "approved";

  // Salva a preferência e gera o link
  $preference->save();

  // Limpar o carrinho após criar o pedido
  unset($_SESSION["cart_item"]);

  // Redirecionar para o link de pagamento do Mercado Pago
  header("Location: $preference->init_point");
  exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Finalizar Compra</title>
  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <div class="site-wrapper">
    <?php require_once 'header.php'; ?>

    <div class="page-wrapper">
      <div class="top-links">
        <div class="container">
          <ul class="row links">
            <li class="col-xs-12 col-sm-4 link-item"><span>1</span><a href="restaurants.php">Escolha o Restaurante</a></li>
            <li class="col-xs-12 col-sm-4 link-item "><span>2</span><a href="#">Escolha sua comida favorita</a></li>
            <li class="col-xs-12 col-sm-4 link-item active"><span>3</span><a href="checkout.php">Pedido e Pagamento</a></li>
          </ul>
        </div>
      </div>

      <div class="container">
        <span style="color:green;">
          <?php echo $success; ?>
        </span>
      </div>

      <div class="container m-t-30">
        <form action="" method="post">
          <div class="widget clearfix">
            <div class="widget-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="cart-totals margin-b-20">
                    <div class="cart-totals-title">
                      <h4>Resumo do Carrinho</h4>
                    </div>
                    <div class="cart-totals-fields">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td>Subtotal do Carrinho</td>
                            <td><?php echo "R$" . number_format($item_total, 2, ',', '.'); ?></td>
                          </tr>
                          <tr>
                            <td>Taxas de Entrega</td>
                            <td>Grátis</td>
                          </tr>
                          <tr>
                            <td class="text-color"><strong>Total</strong></td>
                            <td class="text-color"><strong><?php echo "R$" . number_format($item_total, 2, ',', '.'); ?></strong></td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                  <div class="payment-option">
                    <p class="text-xs-center"> 
                      <input type="submit" name="submit" class="btn btn-outline-success btn-block" value="Fazer Pedido"> 
                    </p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>

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
