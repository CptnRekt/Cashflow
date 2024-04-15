<?php
    //rozpoczyna globalną sesję (zapisywanie i odczytywanie danych globalnych)
    session_start();
    //definiowanie globalnych zmiennych (@ oznacza ignoruj errory)
    @($_SESSION['id_konta']);
    @($_SESSION['login']);
    @($_SESSION['haslo']);
    @($_SESSION['email']);
?>
<!--ustalenie, ze dokument to html-->
<!DOCTYPE html>
<!--jezyk polski-->
<html lang="pl">

<!--metainformacje-->
<head>
    <!--polskie znaki-->
    <meta charset="UTF-8">
    <!--atrybut X-UA-Compatible gdzie mozemy wymusic poprawne renderowanie strony dla starych przegladarek InternetExplorer wg standardow nowszych przegladarek-->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!--nie jest tego samego rozmiaru co strona internetowa, to jest uzywane w przypadku niektorych wyswietlaczy, gdzie brany jest pod uwage rozmiar viewporta zamiast strony internetowej, to ustawienie optymalizuje wyswietlanie sie strony w poprawnych rozmiarach dla urzadzen mobilnych-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--nazwa strony-->
    <title>Cashyflow.pl - konto</title>
    <!--w ten sposob podpina sie skrypty-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--w ten sposob podpina sie style-->
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/login.css">
    <link rel="stylesheet" href="style/style.css">
    <style>
        label { color: white; }
        input { max-width: 60%; margin: auto; }
    </style>
</head>

<body>
<!--ustawia rozmiar 100% dla wszystkich rodzajow wyswietlaczy-->
<div class="container-fluid">

<?php
    //jesli z poprzedniej strony zostala wyslana odpowiedz "wyloguj" to wyprintuj w html komunikat o pomyslnym wylogowaniu z konta
    if (isset($_POST["wyloguj"]))
    {
        echo '<center class="mt-5"><h1>Pomyślnie wylogowano z konta</h1></center>';
        //ustaw wartosc zmiennej globalnej o nazwie "zalogowany" na false
        $_SESSION["zalogowany"] = false;
        //nadpisz tablice pustym arrayem
        $_SESSION = Array();
        //zniszcz sesje
        session_destroy();
    }
    //jesli z poprzedniej strony zostala wyslana odpowiedz "zalogowany" to ustaw polaczenie z serwerem mysql
    if (@($_SESSION["zalogowany"]) == true)
    {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "cashflow2";
        $licznik_kont_kredytowych = 0;
        $conn = new mysqli($servername, $username, $password, $dbname);
        //nastepnie tutaj umiesc skrypt "zmien_login_haslo"
        require("skrypty_php/zmien_login_haslo.php");
    }
    //jesli udalo sie zarejestrowac to umieszczamy napis "zarejestrowano"
    if (isset($_SESSION["zarejestrowano"]))
    {
        echo '<center class="mt-5"><h1>Konto zostało pomyślnie zarejestrowane!</h1></center>';
        $_SESSION["zarejestrowano"] = null;
    }
?>

<!--nastepnie narysuj panel_logowania i wyjustuj zawartosc do srodka-->
<div id="panel_logowania" class="row justify-content-center">
    <!--jedna kolumna ma rozmiar: rozmiar dla danego urzadzenia podzielic przez 5; dodatkowo dodaj marginesy o rozmiarze 2, dodaj styl ze "style.css" i dodaj kolor tla-->
    <div class="text-center col-md-5 ml-5 mr-5 mt-5 panele2 bg-secondary">
       <br>    
    <div class="">
        <h2 class="login-h2">Cashyflow.pl</h2>
        <p>Ekran logowania</p>
    </div>
        <!--ten formularz przekierowywuje dane do tej samej strony w celu weryfikacji logowania-->
        <form action="index.php" method="post">
          <div class="form-group">
            <!--atrybut "for" tuz przed inputem o id o takiej samej nazwie co w for w labelsie po prostu jest opisowe, aby wiadomo bylo do czego sie odnosi-->
            <label for="exampleInputEmail1">Login</label>
            <input type="login" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" name="login" placeholder="Wpisz login">
          </div>
          <div class="form-group">
            <label for="exampleInputPassword1">Hasło</label>
            <input type="password" class="form-control" id="exampleInputPassword1" name="haslo" placeholder="Wpisz hasło">
          </div>
            
            <p id="blad" class="info" style="visibility:hidden;position:absolute;">Błędne dane logowania</p>
            
            <?php
                require("skrypty_php/zaloguj.php");
            ?>
          <!--przeslij formularz i zaloguj, albo przejdz do strony rejestracji-->
          <button type="submit" class="btn btn-primary mt-3" name="submit">Zaloguj</button>
          <br> <br>
          <p>lub</p>
            <p><a class="lokacja" style="text-decoration:underline;" href="rejestracja.php">załóż nowe konto</a></p><br>
        </form>
    </div>
</div>

<?php
    require("skrypty_php/panel_zarzadzania_kontem.php");
?>

</div>
</body>
<script src="skrypty/index.js"></script>
</html>