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

                  if (trim($dados['nomeCli']) === "") {
                    $erros['nomeCli'] = 'Campo obrigatório';
                  }
                  if (trim($dados['cpfCli']) === "") {
                    $erros['cpfCli'] = 'Campo obrigatório';
                  }

                  if (!count($erros)) {
                    require_once "../db/conexao.php";
                    $sql = "INSERT INTO cliente (idCliente, nomeCli, cpfCli, emailCli, dataNasCli, enderecoCli, bairroCli, cidadeCli) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

                    $conexao = novaConexao();
                    $stmt = $conexao->prepare($sql);

                    $params = [
                      $dados['idCliente'],
                      $dados['nomeCli'],
                      $dados['cpfCli'],
                      $dados['emailCli'],
                      $dados['dataNasCli'],
                      $dados['enderecoCli'],
                      $dados['bairroCli'],
                      $dados['cidadeCli']
                    ];

                    $stmt->bind_param("isssssss", ...$params);

                    if ($stmt->execute()) {
                      unset($dados);
                    }
                  }
                }
                ?>
                <form class="forms-sample" action="#" method="POST">
                  <div class="form-group">
                    <h4 class="col-md-6 grid-margin">Cadastro de Cliente</h4>
                    <label>Nome</label>
                    <input type="text" class="form-control <?= $erros['nomeCli'] ? 'is-invalid' : '' ?>" id="nomeCli" name="nomeCli" placeholder="">
                    <div class="invalid-feedback">
                      <?= $erros['nomeCli'] ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>CPF</label>
                    <input type="text" class="form-control <?= $erros['cpfCli'] ? 'is-invalid' : '' ?>" id="cpfCli" name="cpfCli" placeholder="">
                    <div class="invalid-feedback">
                      <?= $erros['cpfCli'] ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>E-mail</label>
                    <input type="text" class="form-control <?= $erros['emailCli'] ? 'is-invalid' : '' ?>" id="emailCli" name="emailCli" placeholder="">
                    <div class="invalid-feedback">
                      <?= $erros['emailCli'] ?>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Data de Nascimento</label>
                    <input type="text" class="form-control <?= $erros['dataNasCli'] ? 'is-invalid' : '' ?>" id="dataNasCli" name="dataNasCli" placeholder="">
                    <div class="invalid-feedback">
                      <?= $erros['dataNasCli'] ?>
                    </div>
                  </div>
              </div>
            </div>
          </div>
          <div class="col-md-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="form-group">
                  <label>Endereço</label>
                  <input type="text" class="form-control <?= $erros['enderecoCli'] ? 'is-invalid' : '' ?>" id="enderecoCli" name="enderecoCli" placeholder="">
                  <div class="invalid-feedback">
                    <?= $erros['enderecoCli'] ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label>Bairro</label>
                  <input type="text" class="form-control <?= $erros['bairroCli'] ? 'is-invalid' : '' ?>" id="bairroCli" name="bairroCli" placeholder="">
                  <div class="invalid-feedback">
                    <?= $erros['bairroCli'] ?>
                  </div>
                </div>
                <div class="form-group row">
                  <label>Cidade</label>
                  <input type="text" class="form-control <?= $erros['cidadeCli'] ? 'is-invalid' : '' ?>" id="cidadeCli" name="cidadeCli" placeholder="">
                  <div class="invalid-feedback">
                    <?= $erros['cidadeCli'] ?>
                  </div>
                </div>
              </div>
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