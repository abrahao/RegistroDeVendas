<?php

session_start();

if ($_COOKIE['user']) {
  $_SESSION['user'] = $_COOKIE['user'];
}

if (!$_SESSION['user']) {
  header('Location: login.php');
}
?>
<?php
include_once 'conexao.php';
?>
<?php
include_once "./common/head_2.php";
?>
<div class="container-scroller">
  <?php
  include_once "./common/navbar_2.php";
  ?>
  <div class="container-fluid page-body-wrapper">
    <?php
    include_once "./common/sidebar_2.php";
    ?>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">

    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <form class="forms-sample" action="" method="POST">
                  <div class="form-group">
                    <h4 class="col-md-6 grid-margin">Pedido de Venda</h4>
                    <label for="">Cliente</label>
                    <input type="text" class="form-control <?= $erros['nomeCli'] ? 'is-invalid' : '' ?>" id="nomeCli" name="nomeCli" placeholder="">
                    <div class="invalid-feedback">
                      <?= $erros['nomeCli'] ?>
                    </div>
                  </div>
                  <input type="submit" name="SendPesqMsg" value="Pesquisar">
                </form><br><br>
              </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <?php
                $SendPesqMsg = filter_input(INPUT_POST, 'SendPesqMsg', FILTER_SANITIZE_STRING);
                if ($SendPesqMsg) {
                  $nomeCli = filter_input(INPUT_POST, 'nomeCli', FILTER_SANITIZE_STRING);

                  //SQL para selecionar os registros
                  $result_msg_cont = "SELECT * FROM cliente WHERE nomeCli LIKE '%" . $nomeCli . "%' ORDER BY nomeCli ASC LIMIT 7";
                  $resultado_msg_cont = $conn->prepare($result_msg_cont);
                  $resultado_msg_cont->execute();

                  while ($dados = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC)) {
                    echo "ID. Cliente: " . $dados['idCliente'] . "<br>";
                    echo "nomeCli: " . $dados['nomeCli'] . "<br>";
                    echo "CPF: " . $dados['cpfCli'] . "<br>";
                    echo "E-mail: " . $dados['emailCli'] . "<br>";
                    echo '<br>';
                    ?>
                    <button>
                      <a href="./pedido_vendas_cad.php?idCliente=<?php echo $dados['idCliente']?>&nomeCli=<?php echo $dados['nomeCli']?>">Selecionar</a>
                    </button>
                  <?php
                  echo '<hr>';
                  }
                }
                // "./pedido_vendas_cad.php?idCliente=
                ?>
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
                <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

                <script>
                  $(function() {
                    $("#nomeCli").autocomplete({
                      source: 'proc_pesq_msg.php'
                    });
                  });
                </script>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include_once "./common/scripts.php";
?>
</div>