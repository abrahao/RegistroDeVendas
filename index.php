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
include_once "./forms/common/head.php"
?>

<div class="container-scroller">
  <?php
  include_once "./forms/common/navbar.php";
  ?>
  <div class="container-fluid page-body-wrapper">
    <?php
    include_once "./forms/common/sidebar.php";
    ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive ">
                  <?php
                  if (count($_POST) > 0) {
                    $dados = $_POST;
                    $erros = [];

                    if (trim($dados['nome_emp']) === "") {
                      $erros['nome_emp'] = 'Nome da empresa é obrigatório';
                    }
                    if (!count($erros)) {
                      require_once "./db/conexao.php";

                      $sql = "INSERT INTO empresa (id_emp, nome_emp) VALUES (?,?)";

                      $conexao = novaConexao();
                      $stmt = $conexao->prepare($sql);

                      $params = [
                        $dados['id_emp'],
                        $dados['nome_emp'],
                      ];

                      $stmt->bind_param("is", ...$params);

                      if ($stmt->execute()) {
                        unset($dados);
                      }
                    }
                  }
                  ?>
                  <form action="#" method="POST">
                    <div class="form-group">
                      <label for="nome_emp"><b>Adicionar Cliente</b> (Se o nome do cliente não estiver na lista a baixo)</label>
                      <input type="text" class="form-control <?= $erros['nome_emp'] ? 'is-invalid' : '' ?>" id="nome_emp" name="nome_emp" placeholder="Nome do Cliente" value="<?= $dados['nome_emp'] ?>">
                    </div>
                    <div class="invalid-feedback">
                      <?= $erros['nome_emp'] ?>
                    </div>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                  </form>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-8 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive border rounded p-1">
                  <?php
                  require_once "./db/conexao.php";
                  $id_emp = $_GET['id_emp'];
                  $nome_emp = $_GET['nome_emp'];
                  $sql = "SELECT *  FROM empresa";

                  $conexao = novaConexao();
                  $resultado = $conexao->query($sql);

                  $registros = [];

                  if ($resultado->num_rows > 0) {
                    while ($row = $resultado->fetch_assoc()) {
                      $registros[] = $row;
                    }
                  } elseif ($conexao->error) {
                    echo "Erro: " . $conexao->error;
                  }

                  $conexao->close();
                  ?>
                  <table class="table">
                    <?php foreach ($registros as $registro) : ?>
                      <tbody>
                        <tr>
                          <td style="font-size: 18px;"><?= $registro['nome_emp'] ?></td>
                          <td>
                            <a href="./forms/add_feedback.php?id_emp=<?php echo $registro['id_emp'] ?>&nome_emp=<?php echo $registro['nome_emp'] ?>">
                              <button type="button" class="btn btn-success btn-fw">+Feedback</button>
                            </a>
                          </td>
                        </tr>
                      <?php endforeach ?>
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