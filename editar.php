<?php

    $idcargadocumento = $_GET['idcargadocumento'];
    $codigo = $_GET['codigo'];
    $numeronotafiscal = $_GET['numeronotafiscal'];

    require_once('src/utils/ConnectionFactory.php');

    $conn = ConnectionFactory::getConection();

    $stmt = $conn->prepare("SELECT nfi.id as idnotaitem, produto, descricao, tiporetiradaentregaitem, ca.codigo as codigo FROM carga as ca, cargadocumento as cd, notafiscal as nf, notafiscalitem as nfi WHERE (cd.idcarga = ca.id) AND (cd.idnotafiscal = nf.id) AND (nf.id = nfi.idnotafiscal) AND (nfi.tiporetiradaentregaitem != '0') AND (cd.id = :idcargadocumento);");
    $stmt->bindParam(':idcargadocumento', $idcargadocumento);
    $stmt->execute();

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Index</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">

    
    <style>
        section.Resposta {
            padding: 1%;
        }

        section.dados #descricao{
            margin: 0px 10px 0px 0px; 
        }
    </style>

</head>
<body>

    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="index.php"><button type="button" class="btn btn-warning">Inicio</button></a>
        <div class="container">
            <div class="row">   
                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="procura.php?codigo=<?= $codigo?>"><button type="button" class="btn btn-success">Voltar</button></button></a> 
                    <a class="navbar-brand">Nota Fiscal: </a>
                    <form class="form-inline" method="POST" action="procura.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="<?= $numeronotafiscal ?>" aria-label="Search" id="numeronotafiscal" name='numeronotafiscal' readonly>
                    </form>
                </nav>
            </div>
        </div>
    </header>

    <section class="Resposta">
        <div class="container">
            <div class="row">
                <table style="width:100%; text-align: left">
                <tr>
                    <th>Produto</th>
                    <th>Descricao</th>
                </tr>
                <tr>
                    <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                        <tr>
                            <td><?= $row->produto ?></td>
                            <td><?= $row->descricao ?></td>
                            <td>
                                <a href="excluirProduto.php?notafiscalitem=<?= $row->idnotaitem?>" class="btn btn-small btn-danger">Excluir</a>
                            </td> 
                        </tr>
                    <?php endwhile ?>
                </tr>
                </table>
            </div>
        </div>
    </section>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>