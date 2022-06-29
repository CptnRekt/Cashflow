<?php
    require('sesja.php');
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cashyflow.pl - nowe konto kredytowe</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<link rel="stylesheet" href="style/style.css">
<style type = "text/css">
input, select {
    text-align: center;
    margin-top: 20px;
    margin-bottom: 20px;
}
</style>
</head>

<body>

<nav class="navbar sticky-top navbar-dark bg-dark row">
 <div class="col pr-0 ml-0 mr-0 mt-1 mb-1 align-self-start">
  <h1 class="navbar-brand">Cashyflow.pl</h1>
  <?php 
        echo '<br> <span>
        <a class="lokacja" href="index.php">'.$_SESSION["login"].'</a> / 
        <a class="lokacja" href="dashboard.php">dashboard</a> / 
        <a class="lokacja" href="dodaj_konto_kredytowe.php">nowe konto </a></span>';
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
      <a class="nav-item nav-link" href="#">Wyloguj</a>
      </form>
    </div>
  </div>
</nav>

<div class = "container-fluid vertical-center">
    <div class = "row justify-content-center bg-dark">
        <div class = "row col-11 panele panele2 mt-5" style = "margin-top:35px;margin-bottom:20px;">
            <div class = "text-center col-12 justify-content-center" style = "padding-top:10px;padding-bottom:40px;">

                <h1 class="" style="text-align:center;">Dodawanie nowego konta kredytowego</h1>
                <div class = "panele col" style = "margin-top:20px;margin-bottom:20px;">
                <form action = "dashboard.php" method = "post" enctype = "multipart/form-data">
                Nazwa konta: <input type = "text" name = "nazwa_konta" value = "" required> <br>
                Opis konta: <input type = "text" name = "opis_konta" value = ""> <br>
                Bilans otwarcia: <input type="number" step="any" name="saldo_poczatkowe" placeholder="0" required /> pln <br>
               
                Rodzaj konta:
                <select name="rodzaj_konta" id="rodzaj_konta">
                 <?php
                    $licznik_rodzajow_kont_kredytowych = 0;
                    $sql3 = "select * from rodzaje_kont_kredytowych where id_uzytkownika=".$_SESSION['id_konta'];
                    $result3 = $conn->query($sql3);
                    if ($result3->num_rows > 0) 
                    {
                        while ($row3 = $result3->fetch_assoc()) 
                        {
                            echo '<option value="'.$row3["id"].'">'.$row3["nazwa"].'</option>';
                        }
                    }
                 ?>
                  <option value="inne">inne</option>
                </select> <br>

                <div style="visibility:hidden;position:absolute;" id="rodzaj_konta_text">
                <input type="text" name="rodzaj_konta_text" size="35" placeholder=" Tutaj podaj rodzaj konta (opcjonalnie)"/><br></div>

                Data otwarcia: 
                <input class="date" required type = "date" name = "data_otwarcia" value = ""> <br>

                <div class="row mb-3">
                <div class="col"><button type="submit" class = "btn btn-primary" name = "dodaj_konto_kredytowe">Dodaj</button></div>
                <a href="dashboard.php"><div class="col"><button type="button" class = "btn btn-primary" name = "anuluj_dodawanie_konta_kredytowego">Anuluj</button></a></div>
                <br><br></div>
                </form></div>
            </div>
        </div>
    </div>
</div>

</body>
<script src="skrypty/script.js"></script>
<script src="skrypty/dodaj_konto_kredytowe.js"></script>
</html>

<?php
    $conn->close();
?>