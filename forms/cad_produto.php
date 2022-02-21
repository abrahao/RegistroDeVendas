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
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <br>
                  <?php
                  if (count($_POST) > 0) {
                    $dados = $_POST;
                    $erros = [];

                    if (trim($dados['nomeProduto']) === "") {
                      $erros['nomeProduto'] = 'Campo obrigatório';
                    }
                    if (trim($dados['precoProduto']) === "") {
                      $erros['precoProduto'] = 'Campo obrigatório';
                    }

                    if (!count($erros)) {
                      require_once "../db/conexao.php";
                      $sql = "INSERT INTO produto (idProduto, nomeProduto, precoProduto) VALUES (?, ?, ?)";

                      $conexao = novaConexao();
                      $stmt = $conexao->prepare($sql);

                      $params = [
                        $dados['idProduto'],
                        $dados['nomeProduto'],
                        $dados['precoProduto'],
                        
                      ];

                      $stmt->bind_param("iss", ...$params);

                      if ($stmt->execute()) {
                        unset($dados);
                      }
                    }
                  }
                  ?>
                  <form class="forms-sample" action="#" method="POST">
                    <div class="form-group">
                    <h4 class="col-md-6 grid-margin">Cadastro de Produto</h4>

                      <label for="">Nome do Produto</label>
                      <input type="text" class="form-control <?= $erros['nomeProduto'] ? 'is-invalid' : '' ?>" id="nomeProduto" name="nomeProduto" placeholder="" value="<?= $dados['nomeProduto'] ?>">
                      <div class="invalid-feedback">
                        <?= $erros['nomeProduto'] ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">Preço unitário</label>
                      <input type="double" class="form-control <?= $erros['precoProduto'] ? 'is-invalid' : '' ?>" id="precoProduto" name="precoProduto" placeholder="R$" value="<?= $dados['precoProduto'] ?>">
                      <div class="invalid-feedback">
                        <?= $erros['precoProduto'] ?>
                      </div>
                    </div>
                    
                </div>
              </div>
            </div>
            <div class="col-md-6 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  
                  <span class="card-body d-lg-flex align-items-center">
                    <button type="submit" class="btn btn-primary mr-2">Salvar</button>
                  </span>
                  </form>
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