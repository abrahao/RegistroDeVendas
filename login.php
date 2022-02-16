<?php
session_start();

$user = $_POST['user'];
$senha = $_POST['senha'];

if ($_POST['user']) {
  $usuarios = [
    [
      "nome" => "Cabeção da Silva",
      "user" => "cabeca",
      "senha" => "cabeca",
    ],
  ];

  foreach ($usuarios as $usuario) {
    $userValido = $user === $usuario['user'];
    $senhaValida = $senha === $usuario['senha'];

    if ($userValido && $senhaValida) {
      $_SESSION['erros'] = null;
      $_SESSION['user'] = $usuario['nome'];
      $exp = time() + 60 * 60 * 24 * 30;
      setcookie('user', $usuario['nome'], $exp);
      header('Location: index.php');
    }
  }

  if (!$_SESSION['user']) {
    $_SESSION['erros'] = ['Usuário/Senha inválido!'];
  }
}
?>

<?php
include_once "./forms/common/head.php"
?>

<div class="container-scroller">
  <div class="container-fluid page-body-wrapper full-page-wrapper">
    <div class="content-wrapper d-flex align-items-center auth">
      <div class="row flex-grow">
        <div class="col-lg-4 mx-auto">
          <div class="auth-form-light text-left p-5">
            <div class="brand-logo">
              <img src="./images/logo">
            </div>
            <?php if ($_SESSION['erros']) : ?>
              <div class="erros">
                <?php foreach ($_SESSION['erros'] as $erro) : ?>
                  <p><?= $erro ?></p>
                <?php endforeach ?>
              </div>
            <?php endif ?>
            <form class="pt-3" action="#" method="post">
              <div class="form-group">
                <input type="text" class="form-control form-control-lg" name="user" id="user" placeholder="Usuário">
              </div>
              <div class="form-group">
                <input type="password" class="form-control form-control-lg" name="senha" id="senha" placeholder="Senha">
              </div>
              <div class="mt-3">
                <button class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn">ENTRAR</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>