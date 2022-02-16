<?php 
session_start();

if($_COOKIE['user']) {
    $_SESSION['user'] = $_COOKIE['user'];
}

if(!$_SESSION['user']) {
    header('Location: login.php');
}
?>
<?php
include_once "./common/head_2.php";
?>

<body>
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
        <span class="card-body d-lg-flex align-items-center"></span>
          <div class="content-wrapper">
            <div class="row">
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4>Cliente: <span style="color: blue;"><?php echo $nome_emp = $_GET['nome_emp']; ?></h4>
                    <br>
                    <?php
                    if (count($_POST) > 0) {
                      $dados = $_POST;
                      $erros = [];

                      if (trim($dados['vendedor']) === "") {
                        $erros['vendedor'] = 'Campo obrigatório';
                      }
                      if (trim($dados['prodt_vend']) === "") {
                        $erros['prodt_vend'] = 'Campo obrigatório';
                      }

                      if (!count($erros)) {
                        require_once "../db/conexao.php";
                        $nome_emp = $_GET['nome_emp'];
                        $sql = "INSERT INTO questionario (id_quest, vendedor, prodt_vend, quest_1, quest_2, quest_3, quest_4, quest_5, quest_6, quest_7, id_emp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

                        $conexao = novaConexao();
                        $stmt = $conexao->prepare($sql);

                        $params = [
                          $dados['id_quest'],
                          $dados['vendedor'],
                          $dados['prodt_vend'],
                          $dados['quest_1'],
                          $dados['quest_2'],
                          $dados['quest_3'],
                          $dados['quest_4'],
                          $dados['quest_5'],
                          $dados['quest_6'],
                          $dados['quest_7'],
                          $dados['id_emp'] = $_GET['id_emp']
                        ];

                        $stmt->bind_param("isssssssssi", ...$params);

                        if ($stmt->execute()) {
                          unset($dados);
                        }
                      }
                    }
                    ?>
                    <form class="forms-sample" action="#" method="POST">
                      <div class="form-group">
                        <label for="">Vendedor/Consultor</label>
                        <input list="browsers" type="text" class="form-control <?= $erros['vendedor'] ? 'is-invalid' : '' ?>" id="vendedor" name="vendedor" placeholder="" value="<?= $dados['vendedor'] ?>">
                        <div class="invalid-feedback">
                          <?= $erros['vendedor'] ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">Produto vendido</label>
                        <input list="browsers" type="text" class="form-control <?= $erros['prodt_vend'] ? 'is-invalid' : '' ?>" id="prodt_vend" name="prodt_vend" placeholder="" value="<?= $dados['prodt_vend'] ?>">
                        <datalist id="browsers">
                          <option value="Produto01">
                          <option value="Produto04">
                        </datalist>
                        <div class="invalid-feedback">
                          <?= $erros['prodt_vend'] ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">1 - Como você nos encontrou ou onde/de quem ouviu falar sobre
                          nós?</label>
                        <input type="text" class="form-control <?= $erros['quest_1'] ? 'is-invalid' : '' ?>" id="quest_1" name="quest_1" placeholder="" value="<?= $dados['quest_1'] ?>">
                        <div class="invalid-feedback">
                          <?= $erros['quest_1'] ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">2 - Você indicaria nossa empresa para um amigo ou
                          conhecido?</label>
                        <select required class="form-control <?= $erros['quest_2'] ? 'is-invalid' : '' ?>" name="quest_2" id="quest_2" value="<?= $dados['quest_2'] ?>">
                          <option readonly value="" disabled selected>*</option>
                          <option>Sim</option>
                          <option>Não</option>
                        </select>
                        <div class="invalid-feedback">
                          <?= $erros['quest_2'] ?>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="">3 - Nossos compromissos de venda e entrega com qualidade foram
                          cumpridos?</label>
                        <select required class="form-control <?= $erros['quest_3'] ? 'is-invalid' : '' ?>" name="quest_3" id="quest_3" value="<?= $dados['quest_3'] ?>">
                          <option readonly value="" disabled selected>*</option>
                          <option>Sim</option>
                          <option>Não</option>
                        </select>
                        <div class="invalid-feedback">
                          <?= $erros['quest_3'] ?>
                        </div>
                      </div>
                  </div>
                </div>
              </div>
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">


                    <div class="form-group row">
                      <label for="">4 - De 1 a 5, quais as chances de você seguir
                        comprando/contratando nossos produtos? </label>
                      <select required class="form-control <?= $erros['quest_4'] ? 'is-invalid' : '' ?>" name="quest_4" id="quest_4" value="<?= $dados['quest_4'] ?>">
                        <option readonly value="" disabled selected>*</option>
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                      </select>
                      <div class="invalid-feedback">
                        <?= $erros['quest_4'] ?>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label for="">5 - Como você avalia a qualidade do atendimento realizado
                        por nosso consultor? </label>
                      <select required class="form-control <?= $erros['quest_5'] ? 'is-invalid' : '' ?>" name="quest_5" id="quest_5" value="<?= $dados['quest_5'] ?>">
                        <option readonly value="" disabled selected>*</option>
                        <option>Muito bom</option>
                        <option>Bom</option>
                        <option>Ruim</option>
                      </select>
                      <div class="invalid-feedback">
                        <?= $erros['quest_5'] ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">6 - Você tem algum elogio, crítica ou sugestão de melhoria para
                        a empresa?</label>
                      <textarea type="text" class="form-control <?= $erros['quest_6'] ? 'is-invalid' : '' ?>" id="quest_6" name="quest_6" placeholder="" value="<?= $dados['quest_6'] ?>" cols="30" rows="5"></textarea>
                      <div class="invalid-feedback">
                        <?= $erros['quest_6'] ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="">7 - Outras Informações</label>
                      <textarea type="text" class="form-control <?= $erros['quest_7'] ? 'is-invalid' : '' ?>" id="quest_7" name="quest_7" placeholder="Digite o Feedback" value="<?= $dados['quest_7'] ?>" cols="30" rows="5"></textarea>
                      <div class="invalid-feedback">
                        <?= $erros['quest_7'] ?>
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
</body>

</html>