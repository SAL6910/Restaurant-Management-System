<?php require_once 'globals.php'; ?> <!-- Inclui variáveis globais -->

<header id="header" class="header-scroll top-header headrom">
  <nav class="navbar navbar-dark"> <!-- Barra de navegação escura -->

    <div class="container">
      <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">
        <!-- Botão de menu para dispositivos móveis -->
        &#9776;
      </button>

      <a class="navbar-brand" href="index.php">
        <!-- Link do logotipo que leva à página inicial -->
        <img class="img-rounded" height="50px" src="images/baiao-food-logo.png" alt="Logotipo">
      </a>

      <div class="collapse navbar-toggleable-md float-lg-right" id="mainNavbarCollapse">
        <!-- Menu colapsável para dispositivos móveis -->
        <ul class="nav navbar-nav">
          <li class="nav-item"> 
            <a class="nav-link active" href="index.php">Início <span class="sr-only">(atual)</span></a> 
          </li>

          <li class="nav-item">
            <a class="nav-link active" href="restaurants.php">Restaurantes</a>
          </li>

          <?php
          if (IS_USER_LOGGED_IN) {
            // Links exibidos quando o usuário está logado
            echo  '<li class="nav-item"><a href="pedidos.php" class="nav-link active">Seus Pedidos</a> </li>
                  <li class="nav-item"><a href="logout.php" class="nav-link active">Sair</a> </li>';
          } else {
            // Links exibidos quando o usuário não está logado
            echo '<li class="nav-item"><a href="login.php" class="nav-link active">Entrar</a> </li>
                  <li class="nav-item"><a href="registration.php" class="nav-link active">Cadastrar</a> </li>';
          }
          ?>
        </ul>
      </div>
    </div>
  </nav>
</header>

