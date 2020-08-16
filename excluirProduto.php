<?php 
    $idnotaitem = $_GET['notafiscalitem'];

    require_once('src/utils/ConnectionFactory.php');

    $conn = ConnectionFactory::getConection();

    $stmt = $conn->prepare("DELETE FROM cargaitem WHERE idnotafiscalitem = :idnotaitem");
    $stmt->bindParam(':idnotaitem', $idnotaitem);
    $stmt->execute();

    $stmt = $conn->prepare("UPDATE notafiscalitem SET tiporetiradaentregaitem = 0 WHERE id = :idnotaitem");
    $stmt->bindParam(':idnotaitem', $idnotaitem);
    $stmt->execute();
  
    header("location: index.php");
?>