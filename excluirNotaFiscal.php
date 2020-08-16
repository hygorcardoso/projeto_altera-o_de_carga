<?php

    require_once('src/utils/ConnectionFactory.php');

    $idcargadocumento = $_GET['idcargadocumento'];
    $idnotafiscal = $_GET['idnotafiscal'];

    $conn = ConnectionFactory::getConection();

    $stmt = $conn->prepare("DELETE FROM cargaitem WHERE idcargadocumento = :idcargadocumento;");
    $stmt->bindParam(':idcargadocumento', $idcargadocumento);
    $stmt->execute();

    $stmt = $conn->prepare("DELETE FROM cargadocumento WHERE id = :idcargadocumento;");
    $stmt->bindParam(':idcargadocumento', $idcargadocumento);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE notafiscalitem SET tiporetiradaentregaitem = 0 WHERE idnotafiscal = :idnotafiscal;");
    $stmt->bindParam(':idnotafiscal', $idnotafiscal);
    $stmt->execute();

    header("location: index.php");

?>  