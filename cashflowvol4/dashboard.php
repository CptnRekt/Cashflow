<?php
    require('sesja.php');
?>

<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cashyflow.pl - dashboard</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/style.css">
</head>

<body>

To jest jakiś tekst co dodałem

<?php
    require("skrypty_php/usun_konto_kredytowe.php");
    require("skrypty_php/archiwizuj_konto_kredytowe.php");
    require("skrypty_php/dodaj_konto_kredytowe_sql.php");
    require("filtrowanie/filtrowanieTo jest coś co zmodyfikowałem.php");
?>


  </div>
  <div class="col pl-0 pr-0 ml-0 mr-0 mt-1 mb-2 align-self-end d-flex flex-row-reverse">
  <button class="navbar-toggler ml-2 mr-2 mb-3" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <form class="form-inline mb-3" action="dashboard.php" method="post">
   <?php
    echo '<input class="form-control d-none d-md-block mr-sm-2" type="search" placeholder="Nazwa konta" aria-label="Search" name="szukaj_input" value="'.@($szukaj).'">';
   ?>
    <button class="btn btn-primary w-10 d-none d-md-block my-2 my-sm-0" type="submit" name="szukaj_button">Szukaj</button>
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

<div class="container-fluid row mb-5" style="min-height: 500px;">

    <div id="filtry" class="col-md-3 text-center panele2 ml-5 mt-5">
        <div class = "">
            <form id="form_filtry" action="dashboard.php" method="post">
            <div class = "mt-2 mb-3">
                <div class = "">
                    <h2>Filtry</h2>
                </div>
                <hr>

                <div class = ""  id="accordion">
                    
                    <h3>Rodzaj konta</h3>
                    <div class = "accordion_panel" style="min-height:150px">
                         <?php
                            $licznik_rodzajow_kont_kredytowych = 1;
                            $filtry_rodzaj_konta_checked = "";
                            $sql3 = "select * from rodzaje_kont_kredytowych where id_uzytkownika=".$_SESSION['id_konta'];
                            $result3 = $conn->query($sql3);
                            if ($result3->num_rows > 0) 
                            {
                                while ($row3 = $result3->fetch_assoc()) 
                                {
                                    if (@($_POST['filtry_rodzaj_konta'.$row3["id"]])) $filtry_rodzaj_konta_checked = "checked";
                                    $licznik_rodzajow_kont_kredytowych++;
                                    echo '<label>&nbsp;'.$row3["nazwa"].' 
                                    <input type="checkbox" name="filtry_rodzaj_konta'.$row3["id"].'"
                                    '.$filtry_rodzaj_konta_checked.' style="text-align:center;"></label>';
                                    $filtry_rodzaj_konta_checked = "";
                                }
                            }
                            echo '<input type="hidden" name="filtry_licznik_rodzaj_konta" value='.$licznik_rodzajow_kont_kredytowych.'/>';
                            if (@($_POST["filtry_rodzaj_konta_inne"])) $filtry_rodzaj_konta_checked = "checked";
                            echo '<label>&nbsp;inne <input type="checkbox" name="filtry_rodzaj_konta_inne"
                            '.$filtry_rodzaj_konta_checked.' style="text-align:center;"></label>';
                         ?>
                    </div>
                    
                    <h3>Saldo / przychód / wydatki</h3>
                    <div class = "accordion_panel" style="min-height:150px;">
                    
                        <select name="filtry_saldo_przychod_wydatki" id="filtry_saldo_przychod_wydatki">
                            <option value="saldo_poczatkowe">Saldo początkowe</option>
                            <option value="saldo_koncowe">Saldo końcowe</option>
                            <option value="przychod">Przychód</option>
                            <option value="wydatki">Wydatki</option>
                        </select> <br> <br>
                        
                    <?php
                        echo 
                        '<div id="saldo_poczatkowe_div" class="divy_saldo_przychod_wydatki" style="">
                        <input style="width:35%;" type = "number" step="any" placeholder = "od" name="filtry_saldo_poczatkowe_od" value="'.@($_POST["filtry_saldo_poczatkowe_od"]).'"> pln - 
                        <input style="width:35%;" type = "number" step="any" placeholder = "do" name="filtry_saldo_poczatkowe_do" value="'.@($_POST["filtry_saldo_poczatkowe_do"]).'"> pln
                        </div>
                        
                        <div id="saldo_koncowe_div" class="divy_saldo_przychod_wydatki" style="visibility:hidden;position:absolute">
                        <input style="width:35%;" type = "number" step="any" placeholder = "od" name="filtry_saldo_koncowe_od" value="'.@($_POST["filtry_saldo_koncowe_od"]).'"> pln - 
                        <input style="width:35%;" type = "number" step="any" placeholder = "do" name="filtry_saldo_koncowe_do" value="'.@($_POST["filtry_saldo_koncowe_do"]).'"> pln
                        </div>
                        
                        <div id="przychod_div" class="divy_saldo_przychod_wydatki" style="visibility:hidden;position:absolute">
                        <input style="width:35%;" type = "number" step="any" placeholder = "od" name="filtry_laczne_przychody_od" value="'.@($_POST["filtry_laczne_przychody_od"]).'"> pln - 
                        <input style="width:35%;" type = "number" step="any" placeholder = "do" name="filtry_laczne_przychody_do" value="'.@($_POST["filtry_laczne_przychody_do"]).'"> pln
                        </div>
                        
                        <div id="wydatki_div" class="divy_saldo_przychod_wydatki" style="visibility:hidden;position:absolute">
                        <input style="width:35%;" type = "number" step="any" placeholder = "od" name="filtry_laczne_wydatki_od" value="'.@($_POST["filtry_laczne_wydatki_od"]).'"> pln - 
                        <input style="width:35%;" type = "number" step="any" placeholder = "do" name="filtry_laczne_wydatki_do" value="'.@($_POST["filtry_laczne_wydatki_do"]).'"> pln
                        </div>';
                    ?>
                    </div>

                    <h3>Data stworzenia rachunku</h3>
                    <div class = "accordion_panel">
                    <?php
                        echo '<input class="" type="date" name="data_rachunku" value="'.@($_POST["data_rachunku"]).'">';
                    ?>
                    </div>
                    
                    <h3>Jakie konta pokazać?</h3>
                    <div class = "accordion_panel">
                    <?php
                        $z_archiwum = "";
                        $nie_z_archiwum = "checked";
                        if (isset($_POST["z_archiwum"])) $z_archiwum = "checked";
                        if (isset($_POST["nie_z_archiwum"])) $nie_z_archiwum = "checked";
                        if (!isset($_POST["z_archiwum"])) $z_archiwum = "";
                        if (!isset($_POST["nie_z_archiwum"])) $nie_z_archiwum = "";
                        echo
                        '<label>Zarchiwizowane&nbsp;<input type="checkbox" name="z_archiwum" '.$z_archiwum.'></label>
                        <label>&nbsp;Niezarchiwizowane&nbsp;<input type="checkbox" name="nie_z_archiwum" '.$nie_z_archiwum.'></label>';
                    ?>
                    </div>
                    
                </div>

                <div class = "filters-footer mt-5 mb-5 btn-group">
                    <button type="submit" class = "btn btn-primary" name = "zastosuj_filtry">Zastosuj filtry</button> &nbsp; &nbsp;
                    <a href="dashboard.php"><button type="button" class = "btn btn-primary" name = "resetuj_filtry">Resetuj filtry</button></a>
                </div>
            </div>
            </form>
        </div>
    </div>

    <div class="col text-center panele2 ml-5 mt-5 pb-4" style="overflow:auto; max-height:512px;
     border-top-right-radius:0px; border-bottom-right-radius:0px;">
            <?php
                require("skrypty_php/szukaj.php")
            ?>
    </div>

</div>

<footer class="bg-dark w-100">
  <div class="p-4 w-100">
    <div class="row">
     
      <div class="col mb-md-0 align-self-start text-left">
         <form action="dodaj_konto_kredytowe.php" method="post">
          <button class="btn btn-primary" type="submit">Dodaj nowe konto</button>
         </form>
      </div>
      
      <div class="col mb-md-0 align-self-end text-right">
        <?php
            $laczne_wydatki = 0;
            $laczne_przychody = 0;
            $saldo_koncowe = 0;
            $sql3 = 'select sum(tt2.laczne_przychody) as laczne_przychody, sum(tt2.laczne_wydatki) as laczne_wydatki, sum(tt2.saldo_koncowe) as
            saldo_koncowe from ('.$sql_przefiltrowany.') tt2 where id_uzytkownika='.$_SESSION["id_konta"].' group by tt2.id_uzytkownika';
            $result3 = $conn->query($sql3);
            if (@($result3->num_rows > 0)) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $laczne_wydatki = $row3["laczne_wydatki"];
                    $laczne_przychody = $row3["laczne_przychody"];
                    $saldo_koncowe = $row3["saldo_koncowe"];
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

</body>
    <script src="skrypty/script.js"></script>      
    <script src="skrypty/dashboard.js"></script>
</html>

<?php
    $conn->close();
?>