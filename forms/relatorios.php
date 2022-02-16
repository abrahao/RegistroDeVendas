<?php 
session_start();

if($_COOKIE['user']) {
    $_SESSION['user'] = $_COOKIE['user'];
}

if(!$_SESSION['user']) {
    header('Location: login.php');
}
?>

<style>
  table,
  th,
  td {
    border: 1px solid black;
    border-collapse: collapse;
  }

  th,
  td {
    padding: 5px;
    text-align: left;
    font-size: 10px;
  }
</style>
<?php
include_once "./common/head_2.php";
?>
<div class="container-scroller">
  <?php
  include_once "./common/navbar_4.php";
  ?>
  <div class="container-fluid page-body-wrapper">
    <?php
    include_once "./common/sidebar_2.php"
    ?>
    <div class="main-panel">
      <div class="content-wrapper">
        <div class="row">
          <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="table-responsive border rounded p-1">
                  <?php
                  require_once "../db/conexao.php";
                  $id_emp = $_GET['id_emp'];
                  $nome_emp = $_GET['nome_emp'];

                  $sql = "SELECT * FROM empresa e, questionario f WHERE e.id_emp=f.id_emp";

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
                  
                  <div class="form-group">

                  <!-- Falta implementar essa função -->
                  Data Inicial  <input type="date">   Data Final <input type="date">
                  </div>
                  <table style="width:100%">
                    <tr>
                      <th>Data</th>
                      <th>Cliente</th>
                      <th>Produto</th>
                      <th>Vendedor</th>
                      <th>Onde nos encontrou</th>
                      <th>Indicaria a empresa</th>
                      <th>Compromissos cumpridos</th>
                      <th>Continuará com a empresa - 1 a 5</th>
                      <th>Qualidade do atendimento</th>
                      <th>Elogios, críticas, sugestões 6</th>
                      <th>Outras informações</th>
                    </tr>
                    <?php foreach ($registros as $registro) : ?>
                      <tr>
                        <td style="font-size: 12px"><?= date('d/m/Y', strtotime($registro['data_cad'])) ?></td>
                        <td style="font-size: 12px;"><?= $registro['nome_emp'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['prodt_vend'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['vendedor'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_1'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_2'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_3'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_4'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_5'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_6'] ?></td>
                        <td style="font-size: 12px;"><?= $registro['quest_7'] ?></td>
                      </tr>
                    <?php endforeach ?>
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
<?php
include_once "./common/scripts.php";
?>