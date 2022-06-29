<?php
    if (isset($_POST["dodaj_transakcje"]))
    {
        $nazwa = @($_POST["nazwa_transakcji"]);
        $rodzaj_transakcji;
        $kategoria_transakcji = @($_POST["kategoria"]);
        $kwota_transakcji = @($_POST["kwota_transakcji"]);
        $data_transakcji = @($_POST["data_transakcji"]);
        $wykonane = 0;
        if (isset($_POST["wykonane"])) $wykonane = 1;
        if ($_POST["rodzaj_transakcji"] == "przychod") 
        {
            $rodzaj_transakcji = "Przychód";
            $sql3 = 'Update konta_kredytowe set laczne_przychody=laczne_przychody+'.$kwota_transakcji.', 
            saldo_koncowe=saldo_koncowe+'.$kwota_transakcji.' where id='.$_SESSION["id_konta_kredytowego"];
            $conn->query($sql3);
            
        }
        if ($_POST["rodzaj_transakcji"] == "wydatek")
        {
            $rodzaj_transakcji = "Wydatek";
            $sql3 = 'Update konta_kredytowe set laczne_wydatki=laczne_wydatki+'.$kwota_transakcji.', 
            saldo_koncowe=saldo_koncowe-'.$kwota_transakcji.' where id='.$_SESSION["id_konta_kredytowego"];
            $conn->query($sql3);
        }
        if (!empty($_POST["kategoria_transakcji_text"]))
        {
            $kategoria_transakcji = $_POST["kategoria_transakcji_text"];
        }
        else
        {
            $kategoria_transakcji = @($_POST["kategoria_transakcji"]);
            $sql3 = @("Select nazwa from kategorie_transakcji where id=".$kategoria_transakcji);
            $result3 = $conn->query($sql3);
            if (@($result3->num_rows > 0)) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $kategoria_transakcji = $row3["nazwa"];
                }
            }
        }
        $sql3 = @("Insert into transakcje_kont_kredytowych (nazwa, rodzaj_transakcji, kategoria,
        data_transakcji, kwota, wykonane, id_konta_kredytowego) values
        ('$nazwa','$rodzaj_transakcji','$kategoria_transakcji','$data_transakcji','
        $kwota_transakcji','$wykonane',".$_SESSION['id_konta_kredytowego'].")");

        if ( $conn->query( $sql3 ) === TRUE ) {
        //echo "<h3><br>Operacja zakończona sukcesem</h3><br>";
        } else {
            echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            echo "<h3>Wystąpił błąd edycji / dodawania rekordu. Jeśli błąd się powtarza, skontaktuj się z właścicielem strony za pomocą maila lub połączenia telefonicznego. Z góry dziękujemy za współpracę.</h3><br>";
        }  
    }
?>