<?php

    session_start();

    if(isset($_SESSION['flash'])){
        $error = $_SESSION['flash']['error'];
        $message = $_SESSION['flash'][' '];
        //não esquecer dessa linha, senão não é flash message.
        unset($_SESSION['flash']);
    };
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajuste de Carga</title>

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
                    <a class="navbar-brand">Ajuste de Carga</a>
                    <form class="form-inline" method="POST" action="procura.php">
                        <input class="form-control mr-sm-2" type="search" placeholder="Procurar" aria-label="Search" id="codigo" name='codigo' required>
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Procurar</button>
                    </form>
                </nav>
            </div>
        </div>
    </header>
    
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="js/jquery-3.5.1.slim.min.js"></script>
    <script src="js/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
</body>
</html>