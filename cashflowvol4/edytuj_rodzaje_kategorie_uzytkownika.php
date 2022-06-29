<?php
    require('sesja.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cashyflow.pl - edycja rodzajów kont kredytowych i kategorii transakcji</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style/style.css">
</head>
<body>

<nav class="navbar sticky-top navbar-dark bg-dark row">
 <div class="col pr-0 ml-0 mr-0 mt-1 mb-1 align-self-start">
  <h1 class="navbar-brand">Cashyflow.pl</h1>
  <?php 
        echo '<br> <span>
        <a class="lokacja" href="index.php">'.$_SESSION["login"].'</a> / 
        <a class="lokacja" href="edytuj_rodzaje_kategorie_uzytkownika.php">edycja rodzajów kont kredytowych oraz kategorii transakcji</a></span>';
  ?>
  </div>
  <div class="col pl-0 pr-0 ml-0 mr-0 mt-1 mb-2 align-self-end d-flex flex-row-reverse">
  <button class="navbar-toggler ml-2 mr-2" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  </div>
  <div class="collapse navbar-collapse" id="navbarToggleExternalContent">
    <div class="navbar-nav text-center">
      <a class="nav-item nav-link active" href="dashboard.php">Home / dashboard / strona główna</a>
      <a class="nav-item nav-link" href="index.php">Ustawienia konta</a>
      <form id="wyloguj" action="index.php" method="post">
      <input type="hidden" id="wyloguj_input" name="wyloguj"/>
      <a class="nav-item nav-link" href="#" onclick="wyloguj()" name="wyloguj_button">Wyloguj</a>
      </form>
    </div>
  </div>
</nav>

<div class = "container-fluid vertical-center">
    <div class = "row justify-content-center bg-dark">
        <div class = "row col-11 panele panele2 mt-5 mb-5" style = "margin-top:35px;margin-bottom:20px;">
            <div class = "text-center col-12 justify-content-center" style = "padding-top:10px;padding-bottom:40px;">
                <form action = "edytuj_rodzaje_kategorie_uzytkownika.php" method = "post">
                <?php
                    require("skrypty_php/edytuj_rodzaje_kategorie_uzytkownika_sql.php");
                    require("skrypty_php/tabelki.php");    
                ?>
                <div class="row mb-3">
                    <div class="col"><button type="submit" class = "btn btn-primary" name = "zatwierdz_edycje_rodzajow_kategorii">Zatwierdź</button></div>
                    <div class="col"><a href="index.php"><button type="button" class = "btn btn-primary" name = "anuluj_edycje_rodzajow_kategorii">Anuluj</button></a></div>
                <br></div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>

<script>
    $("label").css("border-style","solid");
    $("label").css("border-color","white");
    $("label").css("padding-left","20px");
    $("label").css("padding-right","20px");
    $("label").addClass("m-1");
    $("label").css("padding-left","0");
</script>
<script src="skrypty/script.js"></script>
<script src="skrypty/tabelki.js"></script>
</html>

<?php
    $conn->close();
?>