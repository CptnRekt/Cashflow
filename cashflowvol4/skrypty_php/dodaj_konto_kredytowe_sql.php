<?php
    if (isset($_POST["dodaj_konto_kredytowe"]))
    {
        $nazwa = @($_POST["nazwa_konta"]);
        $opis = @($_POST["opis_konta"]);
        $saldo_poczatkowe = @($_POST["saldo_poczatkowe"]);
        $data_otwarcia = @($_POST["data_otwarcia"]);
        if (!empty($_POST["rodzaj_konta_text"]))
        {
            $rodzaj_konta = $_POST["rodzaj_konta_text"];
        }
        else
        {
            $rodzaj_konta = @($_POST["rodzaj_konta"]);
            $sql3 = @("Select nazwa from rodzaje_kont_kredytowych where id=".$rodzaj_konta);
            $result3 = $conn->query($sql3);
            if (@($result3->num_rows > 0)) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $rodzaj_konta = $row3["nazwa"];
                }
            }
        }
        if ($saldo_poczatkowe>0)
        {
            $sql3 = @("Insert into konta_kredytowe (nazwa, opis, rodzaj_konta, saldo_poczatkowe,
            saldo_koncowe, laczne_przychody, laczne_wydatki, data_otwarcia, archiwum, id_uzytkownika) values
            ('$nazwa','$opis','$rodzaj_konta','$saldo_poczatkowe','$saldo_poczatkowe',$saldo_poczatkowe,0,'
            $data_otwarcia',0,".$_SESSION['id_konta'].")");
            $id_nowego_konta_kredytowego = 0;
            if ($conn->query($sql3) === TRUE) 
            {
                $id_nowego_konta_kredytowego = $conn->insert_id;
            }
            $sql3 = ("Insert into transakcje_kont_kredytowych (nazwa, rodzaj_transakcji,
            kategoria, data_transakcji, kwota, id_konta_kredytowego, wykonane) values
            ('Start','Przychód','Start','$data_otwarcia','$saldo_poczatkowe',
            '$id_nowego_konta_kredytowego',0)");
            if ($conn->query($sql3) === TRUE) 
            {
                $id_nowego_konta_kredytowego = $conn->insert_id;
            }
            else
            {
                echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            }
        }
        elseif ($saldo_poczatkowe<0)
        {
            $sql3 = @("Insert into konta_kredytowe (nazwa, opis, rodzaj_konta, saldo_poczatkowe,
            saldo_koncowe, laczne_przychody, laczne_wydatki, data_otwarcia, archiwum, id_uzytkownika) values
            ('$nazwa','$opis','$rodzaj_konta','$saldo_poczatkowe','$saldo_poczatkowe',0,$saldo_poczatkowe,'
            $data_otwarcia',0,".$_SESSION['id_konta'].")");
            $id_nowego_konta_kredytowego = 0;
            if ($conn->query($sql3) === TRUE) 
            {
                $id_nowego_konta_kredytowego = $conn->insert_id;
            }
            $sql3 = ("Insert into transakcje_kont_kredytowych (nazwa, rodzaj_transakcji,
            kategoria, data_transakcji, kwota, id_konta_kredytowego, wykonane) values
            ('Start','Wydatek','Start','$data_otwarcia','$saldo_poczatkowe',
            '$id_nowego_konta_kredytowego',0)");
            if ($conn->query($sql3) === TRUE) 
            {
                $id_nowego_konta_kredytowego = $conn->insert_id;
            }
            else
            {
                echo "Error: " . $sql3 . "<br>" . $conn->error . "<br>";
            }
        }
        elseif ($saldo_poczatkowe==0)
        {
            $sql3 = @("Insert into konta_kredytowe (nazwa, opis, rodzaj_konta, saldo_poczatkowe,
            saldo_koncowe, laczne_przychody, laczne_wydatki, data_otwarcia, archiwum, id_uzytkownika) values
            ('$nazwa','$opis','$rodzaj_konta',0,0,0,0,'
            $data_otwarcia',0,".$_SESSION['id_konta'].")");
            $id_nowego_konta_kredytowego = 0;
            if ($conn->query($sql3) === TRUE) 
            {
                $id_nowego_konta_kredytowego = $conn->insert_id;
            }
        }
    }
?>