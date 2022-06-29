<?php
    if (isset($_POST["zatwierdz_edycje_rodzajow_kategorii"]))
    {
        $czy_cokolwiek_zostalo = null;
        $nazwa_rk = null;
        $licznik_rk = $_POST["licznik"];
        if (isset($_POST["kategorie"]))
        {
            $sql3 = "delete from kategorie_transakcji where id_konta_uzytkownika=".$_SESSION["id_konta"];
            if ( $conn->query( $sql3 ) === TRUE ) {} else {
                echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            }
            $sql3 = "insert into kategorie_transakcji (nazwa, id_konta_uzytkownika) values ";
        }
        if (isset($_POST["rodzaje"]))
        {
            $sql3 = "delete from rodzaje_kont_kredytowych where id_uzytkownika=".$_SESSION["id_konta"];
            if ( $conn->query( $sql3 ) === TRUE ) {} else {
                echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            }
            $sql3 = "insert into rodzaje_kont_kredytowych (nazwa, id_uzytkownika) values ";
        }
        for( $i = 1; $i < $licznik_rk; $i++ )  
        {
            if (isset($_POST["licznikNazwa".$i]))
            {
                $nazwa_rk = @($_POST["licznikNazwa".$i]);
                $sql3 = $sql3.'("'.$nazwa_rk.'",'.$_SESSION["id_konta"].'), ';
                $czy_cokolwiek_zostalo = true;
            }
        }
        if ($czy_cokolwiek_zostalo == true)
        {
            $sql3 = substr($sql3,0,-2);
            if ( $conn->query( $sql3 ) === TRUE ) {} else {
                echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            }
        }
    }
?>