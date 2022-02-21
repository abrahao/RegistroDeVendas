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
include_once "../common/head_2.php";
?>
<div class="container-scroller">
    <?php
    include_once "../common/navbar_2.php";
    ?>
    <div class="container-fluid page-body-wrapper">
        <?php
        include_once "../common/sidebar_2.php";
        ?>
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="row">
                    <div class="col-lg-6 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Produtos Cadastrados</h4>

                                <?php
                                require_once "../../db/conexao.php";
                                $id_emp = $_GET['idProduto'];
                                $sql = "SELECT *  FROM produto";

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

                                <table class="table table-striped">

                                    <thead>
                                        <tr>
                                            <th>
                                                <h4> Código </h4>
                                            </th>
                                            <th>
                                                <h4> Produto</h4>
                                            </th>
                                            <th>
                                                <h4> Preço </h4>
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php foreach ($registros as $registro) : ?>
                                            <tr>
                                                <td><?= $registro['idProduto'] ?> </td>
                                                <td><?= $registro['nomeProduto'] ?></td>
                                                <td><?= $registro['precoProduto'] ?></td>
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
    <?php
    include_once "./common/scripts.php";
    ?>
</div>