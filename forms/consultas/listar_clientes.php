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
                    <div class="col-lg-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Listar Clientes</h4>
                                <?php
                                require_once "../../db/conexao.php";
                                $id_emp = $_GET['idProduto'];
                                $sql = "SELECT *  FROM cliente";

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
                                                <h5> Id. Cliente </h5>
                                            </th>
                                            <th>
                                                <h5> Nome </h5>
                                            </th>
                                            <th>
                                                <h5> CPF </h5>
                                            </th>
                                            <th>
                                                <h5> E-mail </h5>
                                            </th>
                                            <th>
                                                <h5> Data de Nascimento </h5>
                                            </th>
                                            <th>
                                                <h5> Endereço </h5>
                                            </th>
                                            <th>
                                                <h5> Bairro </h5>
                                            </th>
                                            <th>
                                                <h5> Cidade </h5>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($registros as $registro) : ?>
                                            <tr>
                                                <td><?= $registro['idCliente'] ?> </td>
                                                <td><?= $registro['nomeCli'] ?> </td>
                                                <td><?= $registro['cpfCli'] ?> </td>
                                                <td><?= $registro['emailCli'] ?> </td>
                                                <td><?= $registro['dataNasCli'] ?> </td>
                                                <td><?= $registro['enderecoCli'] ?> </td>
                                                <td><?= $registro['bairroCli'] ?> </td>
                                                <td><?= $registro['cidadeCli'] ?> </td>
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