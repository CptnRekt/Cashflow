<?php
    if (@($_SESSION["zalogowany"]) == true)
    {
            $_SESSION["liczba_transakcji"] = 0;
            $_SESSION["liczba_kont_kredytowych"] = 0;
            $sql3 = 'select count(*) as liczba_kont_kredytowych from konta_kredytowe
            where id_uzytkownika='.$_SESSION['id_konta'].' group by id_uzytkownika';
            $result3 = $conn->query($sql3);
            if ($result3->num_rows > 0) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $_SESSION["liczba_kont_kredytowych"] = $row3["liczba_kont_kredytowych"];
                }
            }
            $sql3 = 'select t2.id_uzytkownika, count(*) as liczba_transakcji from transakcje_kont_kredytowych t1
            join (select id, id_uzytkownika from konta_kredytowe where id_uzytkownika='.$_SESSION['id_konta'].') t2
            on(t1.id_konta_kredytowego=t2.id) group by t2.id_uzytkownika;';
            $result3 = $conn->query($sql3);
            if ($result3->num_rows > 0) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $_SESSION["liczba_transakcji"] = $row3["liczba_transakcji"];
                }
            }
            echo
            '<script>
                $("#panel_logowania").css("visibility","hidden");
                $("#panel_logowania").css("position","absolute");
            </script>
            <nav class="navbar sticky-top navbar-dark bg-dark row">
             <div class="col pr-0 ml-0 mr-0 mt-1 mb-1 align-self-start">
              <h1 class="navbar-brand">Cashyflow.pl</h1>
               <br> <span>
                <a class="lokacja" href="index.php">'.$_SESSION["login"].' - zarządzanie kontem</a>
              </div>
              <div class="col pl-0 pr-0 ml-0 mr-0 mt-1 mb-4 align-self-end d-flex flex-row-reverse">
              <a href="dashboard.php"><button class="btn btn-primary" type="button">
                Powrót do dashboarda
              </button></a>
              </div>
            </nav>

            <form id="wyloguj" action="index.php" method="post" style="position: absolute;">
                  <input type="hidden" id="wyloguj_input" name="wyloguj"/>
            </form>

            <div class="container-fluid row mb-5" style="min-height: 500px;">
                <div id="" class="col text-center panele2 ml-5 mt-5">
                    <h1 class="mt-3 mb-3">Ustawienia konta</h1>
                    <div class="row mb-3">
                        <div id="operacje_konta_buttons" class="col-md-6">
                            <button class="button btn-primary" id="zmien_login">Zmień login</button><br>
                            <button class="button btn-primary" id="zmien_haslo">Zmień hasło</button><br>
                            <form action="edytuj_rodzaje_kategorie_uzytkownika.php" method="post">
                            <button type="submit" class="button btn-primary" name="edytuj_rodzaje" id="edytuj_rodzaje">Edytuj rodzaje kont kredytowych</button><br>
                            <button type="submit" class="button btn-primary" name="edytuj_kategorie" id="edytuj_kategorie">Edytuj kategorie transakcji</button><br>
                            </form>
                            <form id="wyloguj" action="index.php" method="post">
                            <button type="submit" class="button btn-primary" name="wyloguj">Wyloguj</button><br>
                            </form>
                            <button class="button btn-primary" id="usun_konto">Usuń konto</button><br>
                        </div>
                        <div class="col d-none d-md-block linia_pion align-self-end"></div>
                        <div class="col mt-3">
                            <div id="dane_konta">
                                <h2>Dane konta</h2>
                                <p>Email: <b>'.$_SESSION['email'].'</b></p>
                                <p>Login: <b>'.$_SESSION['login'].'</b></p>
                                <p>Liczba kont kredytowych: <b>'.@($_SESSION["liczba_kont_kredytowych"]).'</b></p>
                                <p>Liczba transakcji: <b>'.@($_SESSION["liczba_transakcji"]).'</b></p>
                                <p id="bledne_haslo" style="visibility:hidden;position:absolute;color:red;">Błąd, podano nieprawidłowe wartości</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>';
    }
?>