<?php
    if (isset($_POST["edytuj_konto_uzytkownika_button"]))
    {
        $potwierdzenie_haslem_input = $_POST["potwierdzenie_haslem_input"];
        if ($potwierdzenie_haslem_input == $_SESSION["haslo"])
        {
            if (isset($_POST["login_uzytkownika"]))
            {
                $sql3 = 'update konta_uzytkownikow set login="'.$_POST["login_uzytkownika"].'" where id='.$_SESSION["id_konta"];
                $_SESSION['login'] = $_POST["login_uzytkownika"];
            }
            if (isset($_POST["nowe_haslo_uzytkownika"]))
            {
                $sql3 = 'update konta_uzytkownikow set haslo="'.$_POST["nowe_haslo_uzytkownika"].'" where id='.$_SESSION["id_konta"];
                $_SESSION['haslo'] = $_POST["nowe_haslo_uzytkownika"];
            }
            if (@($_POST["usun_konto_uzytkownika"]) == 1)
            {
                $sql3 = 'delete from konta_uzytkownikow where id='.$_SESSION["id_konta"];
                $_SESSION["zalogowany"] = false;
                $_SESSION = Array();
                session_destroy();
                echo '<center><h1 class="mt-5">Twoje konto zostało pomyślnie usunięte</h1></center>';
            }
            if ( $conn->query($sql3) === TRUE ) {} else {
                echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            }
        }
        else
        {
            echo '<center><h1 style="color:red";>Podano błędne dane!</h1></center>';
            ?><script type="text/javascript">
                document.getElementById('bledne_haslo').style.visibility="visible";
                document.getElementById('bledne_haslo').style.position="static";
            </script><?php    
        }
    }
?>