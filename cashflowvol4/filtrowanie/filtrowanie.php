<?php
    function filtruj_checkboxy($nazwa_licznika,$nazwa_filtra,$nazwa_kolumny_tabeli,$nazwa_tabeli,$nazwa_kolumny_tabeli2)
    {
        global $sql_przefiltrowany;
        global $conn;
        $licznik_filtrowanych_elementow = @($_POST[$nazwa_licznika]);
        $sql30 = "";
        if (isset($_POST[$nazwa_filtra."_inne"]))
        {
            $nazwa_filtrowanego_elementu2 = ' or '.$nazwa_kolumny_tabeli.'="inne"';
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
        }
        for ($j=0;$j<=$licznik_filtrowanych_elementow;$j++)
        {
            $sql3 = "select ".$nazwa_kolumny_tabeli2." from ".$nazwa_tabeli." where id=".$j;
            $result3 = $conn->query($sql3);
            if ($result3->num_rows > 0) 
            {
                while ($row3 = $result3->fetch_assoc()) 
                {
                    $nazwa_filtrowanego_elementu=$row3["nazwa"];
                }
            }
            if(isset($_POST[$nazwa_filtra.$j]))
            {
                $nazwa_filtrowanego_elementu2 = ' or '.$nazwa_kolumny_tabeli.'="'.$nazwa_filtrowanego_elementu.'"';
                $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
            }
        }
        if (!empty($sql30))
        {
            $sql30 = substr($sql30,4);
            $sql30 = " and (".$sql30.")";
            $sql_przefiltrowany = $sql_przefiltrowany.$sql30;
        }
    }
    $szukaj = @($_POST["szukaj_input"]);
    $sql_przefiltrowany;
    $sql3 = "select t1.id, t1.nazwa, t1.opis, t1.rodzaj_konta, t1.data_otwarcia, t1.archiwum, t1.wykres,
    t1.saldo_poczatkowe, t1.saldo_koncowe, t1.laczne_przychody, t1.laczne_wydatki, t1.id_uzytkownika
    FROM konta_kredytowe t1 where t1.id_uzytkownika=".$_SESSION["id_konta"];
    
    if (!isset($_POST["szukaj_button"]))
    {
        $sql3 = $sql3." and t1.nazwa like '%'";
        $_SESSION["szukaj_konta_kredytowe"]="";
    }
    if (isset($_POST["szukaj_button"]))
    {
        $sql3 = $sql3." and t1.nazwa like '%".$szukaj."%'";
        $_SESSION["szukaj_konta_kredytowe"]=$szukaj;
    }
    if (!isset($_POST["zastosuj_filtry"]))
    {
        $sql3 = $sql3." and t1.archiwum=0";
        $_SESSION["archiwum"]=0;
    }

    $sql_przefiltrowany = $sql3;

    if (isset($_POST["zastosuj_filtry"]))
    {
        filtruj_checkboxy("filtry_licznik_rodzaj_konta","filtry_rodzaj_konta","t1.rodzaj_konta","rodzaje_kont_kredytowych","nazwa");
        
        $sql30 = "";
        if (isset($_POST["z_archiwum"]))
        {
            $nazwa_filtrowanego_elementu2 = ' or archiwum="1"';
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
            $_SESSION["archiwum"]=1;
        }
        if (isset($_POST["nie_z_archiwum"]))
        {
            $nazwa_filtrowanego_elementu2 = ' or archiwum="0"';
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
            $_SESSION["archiwum"]=0;
        }
        if (!empty($sql30))
        {
            $sql30 = substr($sql30,4);
            $sql30 = " and (".$sql30.")";
            $sql_przefiltrowany = $sql_przefiltrowany.$sql30;
        }
        
        $sql30 = "";
        if (!empty($_POST["data_rachunku"]))
        {
            $sql30 = 'data_otwarcia="'.$_POST["data_rachunku"].'"';
            $sql30 = " and (".$sql30.")";
            $sql_przefiltrowany = $sql_przefiltrowany.$sql30;
        }
        
        require("filtruj_saldo_przychod_wydatki.php");
        
    }
?>