<?php

    session_start();

    if(isset($_SESSION['flash'])){
        $error = $_SESSION['flash']['error'];
        $message = $_SESSION['flash']['message'];
        //não esquecer dessa linha, senão não é flash message.
        unset($_SESSION['flash']);
    };
    
    $codigo = $_REQUEST['codigo'];

    require_once('src/utils/ConnectionFactory.php');

    $conn = ConnectionFactory::getConection();

    $stmt = $conn->prepare("SElECT cd.id as idcargadocumento, en.razaosocial as cliente, nf.numeronotafiscal as numeronotafiscal, nf.id as idnotafiscal, ca.codigo FROM carga as ca, cargadocumento as cd, entidade as en, notafiscal as nf WHERE (ca.id = cd.idcarga) AND (cd.idcliente = en.id) AND (cd.idnotafiscal = nf.id) AND (ca.codigo = :codigo)");
    $stmt->bindParam(':codigo', $codigo);
    $stmt->execute();
    
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Procura</title>

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap-reboot.min.css">
    <link rel="stylesheet" href="css/bootstrap-grid.min.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    
    <style>
        section.procura #carga {
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <header class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <div class="row">

                <nav class="navbar navbar-light bg-light">
                    <a class="navbar-brand" href="index.php"><button type="button" class="btn btn-warning">Inicio</button></a>
                    <form class="form-inline" method="POST" action="procura.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="<?= $codigo ?>" aria-label="Search" id="numeronotafiscal" name='numeronotafiscal' readonly>
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
                    <th>Nota Fiscal</th>
                    <th>Cliente</th>
                </tr>
                <tr>
                    <?php while($row = $stmt->fetch(PDO::FETCH_OBJ)) : ?>
                        <tr>  
                            <td><?= $row->numeronotafiscal ?>/1</td>
                            <td><?= $row->cliente ?></td>
                            <td>
                                <a href="editar.php?idcargadocumento=<?= $row->idcargadocumento ?>&codigo=<?= $codigo?>&numeronotafiscal=<?= $row->numeronotafiscal?>" class="btn btn-small btn-warning">Editar</a>
                                <a href="excluirNotaFiscal.php?idcargadocumento=<?= $row->idcargadocumento ?>&idnotafiscal=<?= $row->idnotafiscal?>" class="btn btn-small btn-danger">Excluir</a>
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