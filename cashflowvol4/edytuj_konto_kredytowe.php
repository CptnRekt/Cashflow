<?php
    require("sesja.php");
    $licznik_transakcji = 0;
    if(isset($_POST["id_konta_kredytowego"])) $_SESSION["id_konta_kredytowego"] = @($_POST["id_konta_kredytowego"]);
    if(isset($_POST["nazwa_konta_kredytowego"])) $_SESSION["nazwa_konta_kredytowego"] = @($_POST["nazwa_konta_kredytowego"]);
    if(isset($_POST["data_otwarcia"])) $_SESSION["data_otwarcia"] = @($_POST["data_otwarcia"]);
    if(isset($_POST["opis_konta_kredytowego"])) $_SESSION["opis_konta_kredytowego"] = @($_POST["opis_konta_kredytowego"]);
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashyflow.pl - edytuj konto</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
    <script src="skrypty/dashboard.js"></script>
    <script src="skrypty/script.js"></script>
</head>

<body>

<?php
    require("skrypty_php/usun_transakcje.php");
    require("skrypty_php/archiwizuj_transakcje.php");
    require("skrypty_php/dodaj_transakcje_sql.php");
    require("filtrowanie/filtrowanie_transakcji.php");
?>

<nav class="navbar sticky-top navbar-dark bg-dark row">
 <div class="col pr-0 ml-0 mr-0 mt-1 mb-1 align-self-start">
     <h1 class="navbar-brand mr-2">Cashyflow.pl</h1>
     <?php 
        echo '<br> <span><a class="lokacja" href="index.php">'.$_SESSION["login"].'</a> / 
        <a class="lokacja" href="dashboard.php">dashboard</a> / 
        <a class="lokacja" href="edytuj_konto_kredytowe.php">'.$_SESSION["nazwa_konta_kredytowego"].'</a></span>';
     ?>
  </div>
  <div class="col pl-0 pr-0 ml-0 mr-0 mt-1 mb-2 align-self-end d-flex flex-row-reverse">
  <button class="navbar-toggler ml-2 mr-2 mb-3" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form class="form-inline mb-3" action="edytuj_konto_kredytowe.php" method="post">
   <?php
    echo '<input class="form-control d-none d-md-block mr-sm-2" type="search" placeholder="Nazwa transakcji" aria-label="Search" name="szukaj_transakcji_input" value="'.@($szukaj_transakcji).'">';
   ?>
    <button class="btn btn-primary w-10 d-none d-md-block my-2 my-sm-0" type="submit" name="szukaj_transakcji_button">Szukaj</button>
  </form>
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

<div class="container-fluid row btn-group mt-4">
   <?php
        echo '<div class="col-md-3 ml-5"><p>Data otwarcia konta: '.@($_SESSION["data_otwarcia"]).'</p></div>';
    ?>
   <div class="col ml-5" id="rodzaje_transakcji">
        <button class="button btn-primary pokaz_button klikniety_pokaz_button" id="pokaz_wszystko_button" style="">Wszystko</button>&nbsp;
        <button class="button btn-primary pokaz_button nieklikniety_pokaz_button" id="pokaz_przychody_button">Przychody</button>&nbsp;
        <button class="button btn-primary pokaz_button nieklikniety_pokaz_button" id="pokaz_wydatki_button">Wydatki</button>&nbsp;
        <form action="podsumowanie_transakcji.php" method="post" style="display: inline">
        <button class="button btn-primary" style="border-radius: 10px">Analiza</button>&nbsp;
        </form>
    </div>
</div>

<div class="container-fluid row mb-5" style="min-height: 500px;">

    <div id="filtry" class="col-md-3 text-center panele2 ml-5 mt-3">
        <div class = "">
            <form id="form_filtry" action="edytuj_konto_kredytowe.php" method="post">
            <div class = "mt-2 mb-3">
                <div class = "">
                    <h2>Filtry</h2>
                </div>
                <hr>

                <div class = ""  id="accordion">
                   
                    <h3>Kategoria transakcji</h3>
                    <div class = "accordion_panel" style="min-height:150px">
                         <?php
                            $licznik_kategorii = 1;
                            $filtry_kategoria_checked = "";
                            $sql3 = "select * from kategorie_transakcji where id_konta_uzytkownika=".$_SESSION['id_konta'];
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0) 
                            {
                                while ($row3 = $result3->fetch_assoc()) 
                                {
                                    if (@($_POST['filtry_kategoria'.$row3["id"]])) $filtry_kategoria_checked = "checked";
                                    $licznik_kategorii++;
                                    echo '<label>&nbsp;'.$row3["nazwa"].' 
                                    <input type="checkbox" name="filtry_kategoria'.$row3["id"].'"
                                    '.$filtry_kategoria_checked.' style="text-align:center;"></label>';
                                    $filtry_kategoria_checked = "";
                                }
                            }
                            echo '<input type="hidden" name="filtry_licznik_kategoria" value='.$licznik_kategorii.'/>';
                            if (@($_POST["filtry_kategoria_inne"])) $filtry_kategoria_checked = "checked";
                            echo '<label>&nbsp;Inne <input type="checkbox" name="filtry_kategoria_inne"
                            '.$filtry_kategoria_checked.' style="text-align:center;"></label>';
                         ?>
                    </div>
                    
                    <h3>Kwota</h3>
                    <div class = "accordion_panel" style="min-height:150px;">
                    
                        <select name="filtry_przychod_wydatki" class="filtry_przychod_wydatki_visible" id="filtry_przychod_wydatki">
                           <option value="obojetne">Nieokreślone</option>
                            <option value="przychod">Przychód</option>
                            <option value="wydatki">Wydatki</option>
                        </select> <br> <br>
                        
                    <?php
                        echo 
                        '<div id="przychod_div" class="divy_przychod_wydatki" style="visibility:hidden;position:absolute">
                        <input style="width:35%;" type = "number" step="any" placeholder = "od" name="filtry_przychód_od" value="'.@($_POST["filtry_przychód_od"]).'"> - 
                        <input style="width:35%;" type = "number" step="any" placeholder = "do" name="filtry_przychód_do" value="'.@($_POST["filtry_przychód_do"]).'"> pln
                        </div>
                        
                        <div id="wydatki_div" class="divy_przychod_wydatki" style="visibility:hidden;position:absolute">
                        <input style="width:35%;" type = "number" step="any" placeholder = "od" name="filtry_wydatek_od" value="'.@($_POST["filtry_wydatek_od"]).'"> - 
                        <input style="width:35%;" type = "number" step="any" placeholder = "do" name="filtry_wydatek_do" value="'.@($_POST["filtry_wydatek_do"]).'"> pln
                        </div>';
                    ?>
                    </div>
                    
                    <h3>Data wykonania transakcji</h3>
                    <div class = "accordion_panel">
                    <?php
                        echo '<input class="" type="date" name="data_transakcji" value="'.@($_POST["data_transakcji"]).'">';
                    ?>
                    </div>
                    
                    <h3>Jakie transakcje pokazać?</h3>
                    <div class = "accordion_panel">
                    <?php
                        $wykonane = "";
                        $niewykonane = "checked";
                        if (isset($_POST["wykonane"])) $wykonane = "checked";
                        if (isset($_POST["niewykonane"])) $niewykonane = "checked";
                        if (!isset($_POST["wykonane"])) $wykonane = "";
                        if (!isset($_POST["niewykonane"])) $niewykonane = "";
                        echo
                        '<label>Zarchiwizowane&nbsp;<input type="checkbox" name="wykonane" '.$wykonane.'></label>
                        <label>&nbsp;Niezarchiwizowane&nbsp;<input type="checkbox" name="niewykonane" '.$niewykonane.'></label>';
                    ?>
                    </div>
                    
                </div>

                <div class = "filters-footer mt-5 mb-5 btn-group">
                    <button type="submit" class = "btn btn-primary" name = "zastosuj_filtry">Zastosuj filtry</button> &nbsp; &nbsp;
                    <a href="edytuj_konto_kredytowe.php"><button type="button" class = "btn btn-primary" name = "resetuj_filtry">
                    Resetuj filtry</button></a>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="col text-center panele2 ml-5 mt-3 pb-4 szuk" style="overflow:auto; max-height:512px; border-top-right-radius:0px; border-bottom-right-radius:0px;">
    <?php
        require("skrypty_php/szukaj_transakcji.php");
    ?>
    </div>

</div>

<footer class="bg-dark w-100">
  <div class="p-4 w-100">
    <div class="row">
     
      <div class="col mb-md-0 align-self-start text-left">
         <form action="dodaj_transakcje.php" method="post">
          <button class="btn btn-primary" type="submit">Dodaj nową transakcję</button>
         </form>
      </div>
      
      <div class="col text-right">
        <?php
            $laczne_wydatki = 0;
            $laczne_przychody = 0;
            $saldo_koncowe = 0;
            $sql3 = 'select tt2.rodzaj_transakcji as rodzaj_transakcji, sum(tt2.kwota) as laczna_kwota
            from ('.$sql_przefiltrowany.') tt2 group by tt2.rodzaj_transakcji';
            $result3 = $conn->query($sql3);
            if (@($result3->num_rows > 0)) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    if ($row3["rodzaj_transakcji"]=="Przychód")
                    {
                        $laczne_przychody = $row3["laczna_kwota"];
                        $saldo_koncowe = $saldo_koncowe + $laczne_przychody;
                    }
                    if ($row3["rodzaj_transakcji"]=="Wydatek")
                    {
                        $laczne_wydatki = $row3["laczna_kwota"]; 
                        $saldo_koncowe = $saldo_koncowe - $laczne_wydatki;
                    }
                }
            }
            echo
            '<span>Łączne wydatki: '.$laczne_wydatki.' pln</span> <br>
            <span>Łączne przychody: '.$laczne_przychody.' pln</span> <br>
            <span>Całkowite saldo: '.$saldo_koncowe.' pln</span>';
        ?>
      </div>
      
    </div>
  </div>
</footer>

<div class="mb-md-0 text-center">
    <p>Opis konta: <?php echo $_SESSION["opis_konta_kredytowego"]; ?></p>
    <p style="font-size: 0.7em"><strong>
        Uwaga! Łączny balans konta obliczany jest w oparciu o przefiltrowane transakcje widoczne powyżej. 
        Transakcje zarchiwizowane nie są domyślnie widoczne, wobec czego ich kwoty nie są wliczone w zestawienie.
        Można je włączyć w filtrach po lewej stronie.
    </strong></p>
</div>

</body>
<script src="skrypty/edytuj_konto_kredytowe.js"></script>
</html>

<?php
    $conn->close();
?>