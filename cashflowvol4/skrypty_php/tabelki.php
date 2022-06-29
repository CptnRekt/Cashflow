<?php
    $rodzaje;
    $kategorie;
    if (isset($_POST["edytuj_rodzaje"]) || isset($_POST["rodzaje"]))
    {
        $licznik_rk = 0;
        echo '<div id="lista" style="overflow:auto;">
        <h1>Rodzaje kont</h1><br>';
        $sql3 = 'SELECT id, nazwa from rodzaje_kont_kredytowych where id_uzytkownika='.$_SESSION["id_konta"];
        $result3 = $conn->query($sql3);
        while( $row3 = $result3->fetch_assoc() )  {
            $licznik_rk++;
            echo '<label style="color:white;">
            <input type="hidden" style="position:absolute;" name="licznikNazwa'.$licznik_rk.'" id="licznikNazwa'.$licznik_rk.'" value="'.$row3["nazwa"].'">
            <button type="button" class="przyciskUsun" name="usun'.$licznik_rk.'" id="usun'.$licznik_rk.'">X</button>&nbsp;&nbsp;'.$row3["nazwa"].'</label>';
            if ($licznik_rk % 4 == 0)
                echo '<br>';
        }
        $licznik_rk++;
        echo '</div><br><br> <input type="text" id="nowa_nazwa" placeholder="Podaj nazwę rodzaju">';
        echo '<input type="hidden" id="licznik" value='.$licznik_rk.' name="licznik"/>';
        echo '<input type="button" id="dodaj" value="Dodaj nowy rodzaj"/>';
        echo '<br><br><span style="" id="error"></span><br><br>';
        $rodzaje = true;
        echo '<input type="hidden" name="rodzaje" style="position: absolute;" value="'.$rodzaje.'">';
    }
    if (isset($_POST["edytuj_kategorie"]) || isset($_POST["kategorie"]))
    {
        $licznik_rk = 0;
        echo '<div id="lista" style="overflow:auto;">
        <h1>Kategorie transakcji</h1><br>';
        $sql3 = 'SELECT id, nazwa from kategorie_transakcji where id_konta_uzytkownika='.$_SESSION["id_konta"];
        $result3 = $conn->query($sql3);
        while( $row3 = $result3->fetch_assoc() )  {
            $licznik_rk++;
            echo '<label style="color:white;">
            <input type="hidden" style="position:absolute;" name="licznikNazwa'.$licznik_rk.'" id="licznikNazwa'.$licznik_rk.'" value="'.$row3["nazwa"].'">
            <button type="button" class="przyciskUsun" name="usun'.$licznik_rk.'" id="usun'.$licznik_rk.'">X</button>&nbsp;&nbsp;'.$row3["nazwa"].'</label>';
            if ($licznik_rk % 4 == 0)
                echo '<br>';
        }
        $licznik_rk++;
        echo '</div><br><br> <input type="text" id="nowa_nazwa" placeholder="Podaj nazwę kategorii">';
        echo '<input type="hidden" id="licznik" value='.$licznik_rk.' name="licznik"/>';
        echo '<input type="button" id="dodaj" value="Dodaj nową kategorię"/>';
        echo '<br><br><span style="" id="error"></span><br><br>';
        $kategorie = true;
        echo '<input type="hidden" name="kategorie" style="position: absolute;" value="'.$kategorie.'">';
    }
?>