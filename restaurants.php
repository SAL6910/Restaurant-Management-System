<?php
require_once 'connection/connect.php';
require_once 'globals.php';
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
  <title>Restaurantes | BaiaoFood</title>

  <!-- icon da aba -->
  <link rel="icon" href="./icons/restaurants.png" type="image/png">

  <link href="css/bootstrap.min.css" rel="stylesheet">
  <link href="css/font-awesome.min.css" rel="stylesheet">
  <link href="css/animsition.min.css" rel="stylesheet">
  <link href="css/animate.css" rel="stylesheet">
  <link href="css/style.css" rel="stylesheet">
</head>

<body>

  <?php require_once 'header.php'; ?>

  <div class="page-wrapper">
    <div class="top-links">
      <div class="container">
        <ul class="row links">

          <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="#">Escolha o Restaurante</a></li>
          <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Escolha sua Comida Favorita</a></li>
          <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Pedir e Pagar</a></li>
        </ul>
      </div>
    </div>
    <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
      <div class="container"> </div>
    </div>
    <div class="result-show">
      <div class="container">
        <div class="row">
        </div>
      </div>
    </div>
    <section class="restaurants-page">
      <div class="container">
        <div class="row">
          <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
          </div>
          <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
            <div class="bg-gray restaurant-entry">
              <div class="row">
                <?php
                $ress = $db->query("select * from restaurant");
                while ($rows = $ress->fetch_assoc()) {

                  echo ' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
                              <div class="entry-logo">
                                <a class="img-fluid" href="dishes.php?res_id=' . $rows['rs_id'] . '" > <img src="admin/Res_img/' . $rows['image'] . '" alt="Logotipo do Restaurante"></a>
                              </div>
                              <!-- end:Logo -->
                              <div class="entry-dscr">
                                <h5><a href="dishes.php?res_id=' . $rows['rs_id'] . '" >' . $rows['title'] . '</a></h5> <span>' . $rows['address'] . '</span>
                              </div>
                              <!-- end:Entry description -->
                            </div>
                            
                             <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
                                <div class="right-content bg-white">
                                  <div class="right-review">
                                    
                                    <a href="dishes.php?res_id=' . $rows['rs_id'] . '" class="btn theme-btn-dash">Ver Menu</a> 
                                  </div>
                                </div>
                                <!-- end:right info -->
                            </div>';
                }
                ?>

              </div>

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