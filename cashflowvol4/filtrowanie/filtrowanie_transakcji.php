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
    $szukaj = @($_POST["szukaj_transakcji_input"]);
    $sql_przefiltrowany;
    $sql3 = "select t1.id, t1.nazwa, t1.rodzaj_transakcji, t1.kategoria, t1.data_transakcji,
    t1.kwota, t1.wykonane, t1.id_konta_kredytowego FROM transakcje_kont_kredytowych t1
    where t1.id_konta_kredytowego=".$_SESSION["id_konta_kredytowego"];
    
    if (!isset($_POST["szukaj_transakcji_button"]))
    {
        $sql3 = $sql3." and t1.nazwa like '%'";
    }
    if (isset($_POST["szukaj_transakcji_button"]))
    {
        $sql3 = $sql3." and t1.nazwa like '%".$szukaj."%'";
    }
    if (!isset($_POST["zastosuj_filtry"]))
    {
        $sql3 = $sql3." and t1.wykonane=0";
    }

    $sql_przefiltrowany = $sql3;

    if (isset($_POST["zastosuj_filtry"]))
    {
        $sql30 = "";
        if (isset($_POST["wykonane"]))
        {
            $nazwa_filtrowanego_elementu2 = ' or wykonane="1"';
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
            $_SESSION["wykonane"]=1;
        }
        if (isset($_POST["niewykonane"]))
        {
            $nazwa_filtrowanego_elementu2 = ' or wykonane="0"';
            $sql30 = $sql30.$nazwa_filtrowanego_elementu2;
            $_SESSION["wykonane"]=0;
        }
        if (!empty($sql30))
        {
            $sql30 = substr($sql30,4);
            $sql30 = " and (".$sql30.")";
            $sql_przefiltrowany = $sql_przefiltrowany.$sql30;
        }
        
        $sql30 = "";
        if (!empty($_POST["data_transakcji"]))
        {
            $sql30 = 'data_transakcji="'.$_POST["data_transakcji"].'"';
            $sql30 = " and (".$sql30.")";
            $sql_przefiltrowany = $sql_przefiltrowany.$sql30;
        }
        
        filtruj_checkboxy("filtry_licznik_kategoria","filtry_kategoria","t1.kategoria","kategorie_transakcji","nazwa");
        require("filtruj_przychod_wydatki.php");
        
    }
?>